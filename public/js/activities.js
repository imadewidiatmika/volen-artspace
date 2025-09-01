document.addEventListener("DOMContentLoaded", () => {
    const activityModal = new bootstrap.Modal(
        document.getElementById("activityModal")
    );
    const modalTitle = document.getElementById("modalTitle");
    const activityForm = document.getElementById("activityForm");
    const validationErrors = document.getElementById("validationErrors");
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    // Ambil URL dari data-attributes di form
    const storeUrl = activityForm.dataset.storeUrl;
    const updateUrlTemplate = activityForm.dataset.updateUrl;

    window.clearErrors = function () {
        validationErrors.innerHTML = "";
        validationErrors.classList.add("d-none");
    };

    window.openAddModal = function () {
        activityForm.reset();
        clearErrors();
        modalTitle.textContent = "Add New Activity";
        activityForm.setAttribute("data-action-type", "add");
        activityModal.show();
    };

    window.openEditModal = function (id) {
        fetch(`/admin/activities/${id}/edit`)
            .then((response) => response.json())
            .then((data) => {
                activityForm.reset();
                clearErrors();
                modalTitle.textContent = "Edit Activity";
                activityForm.setAttribute("data-action-type", "edit");
                activityForm.setAttribute("data-id", id);
                document.getElementById("name").value = data.name;
                activityModal.show();
            })
            .catch((error) => console.error("Error loading edit data:", error));
    };

    activityForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const actionType = this.getAttribute("data-action-type");
        const id = this.getAttribute("data-id");
        let url = storeUrl; // Gunakan URL untuk 'store' secara default
        const formData = new FormData(this);

        if (actionType === "edit") {
            url = updateUrlTemplate.replace("ACTIVITY_ID", id); // Ganti placeholder dengan ID
            formData.append("_method", "PUT");
        }

        fetch(url, {
            method: "POST",
            headers: { "X-CSRF-TOKEN": csrfToken, Accept: "application/json" },
            body: formData,
        })
            .then(async (response) => {
                const data = await response.json();
                if (!response.ok) {
                    throw data;
                }
                return data;
            })
            .then((data) => {
                if (data.success) {
                    activityModal.hide();
                    alert(data.success);
                    location.reload();
                }
            })
            .catch((errorData) => {
                console.error("Submit Error:", errorData);
                if (errorData.errors) {
                    let errorMessages = "<ul>";
                    for (const key in errorData.errors) {
                        errorMessages += `<li>${errorData.errors[key][0]}</li>`;
                    }
                    errorMessages += "</ul>";
                    validationErrors.innerHTML = errorMessages;
                    validationErrors.classList.remove("d-none");
                } else {
                    alert(errorData.message || "An unexpected error occurred.");
                }
            });
    });

    window.deleteActivity = function (id) {
        if (confirm("Are you sure you want to delete this activity?")) {
            const deleteUrl = updateUrlTemplate.replace("ACTIVITY_ID", id); // URL sama dengan update
            fetch(deleteUrl, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert(data.success);
                        location.reload();
                    } else if (data.error) {
                        alert(data.error);
                    }
                })
                .catch((error) => console.error("Delete Error:", error));
        }
    };
});
