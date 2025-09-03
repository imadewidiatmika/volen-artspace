// public/js/participants.js
document.addEventListener("DOMContentLoaded", function () {
    const modalElement = document.getElementById("participantModal");
    if (!modalElement) return;

    const participantModal = new bootstrap.Modal(modalElement);
    const modalTitle = document.getElementById("modalTitle");
    const participantForm = document.getElementById("participantForm");
    const validationErrors = document.getElementById("validationErrors");
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    // Open Add Modal
    window.openAddModal = function () {
        participantForm.reset();
        validationErrors.innerHTML = "";
        validationErrors.classList.add("d-none");
        modalTitle.textContent = "Add New Participant";
        participantForm.action = document.body.dataset.storeUrl;
        document.querySelector('input[name="_method"]').value = "POST";
        participantModal.show();
    };

    // Open Edit Modal
    window.openEditModal = function (id) {
        fetch(`${document.body.dataset.baseUrl}/${id}/edit`)
            .then((response) => response.json())
            .then((data) => {
                participantForm.reset();
                validationErrors.innerHTML = "";
                validationErrors.classList.add("d-none");
                modalTitle.textContent = "Edit Participant";
                participantForm.action = `${document.body.dataset.baseUrl}/${id}`;
                document.querySelector('input[name="_method"]').value = "PUT";

                // Populate form
                for (const key in data) {
                    if (document.getElementById(key)) {
                        document.getElementById(key).value = data[key];
                    }
                }
                participantModal.show();
            });
    };

    // Submit Form
    participantForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const method = document.querySelector('input[name="_method"]').value;

        fetch(this.action, {
            method: "POST", // Always POST for forms, use _method field for PUT/PATCH
            headers: { "X-CSRF-TOKEN": csrfToken, Accept: "application/json" },
            body: formData,
        })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) throw data;
                return data;
            })
            .then((data) => {
                participantModal.hide();
                alert(data.success);
                window.location.reload();
            })
            .catch((errorData) => {
                if (errorData.errors) {
                    let errorMessages = "<ul>";
                    for (const key in errorData.errors) {
                        errorMessages += `<li>${errorData.errors[key][0]}</li>`;
                    }
                    errorMessages += "</ul>";
                    validationErrors.innerHTML = errorMessages;
                    validationErrors.classList.remove("d-none");
                } else {
                    alert(errorData.message || "An error occurred.");
                }
            });
    });

    // Delete Participant
    window.deleteParticipant = function (id, url) {
        if (!confirm("Are you sure you want to delete this participant?"))
            return;
        fetch(url, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": csrfToken, Accept: "application/json" },
        })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) throw data;
                return data;
            })
            .then((data) => {
                alert(data.success);
                window.location.reload();
            })
            .catch((errorData) => {
                alert(errorData.error || "Could not delete participant.");
            });
    };
});
