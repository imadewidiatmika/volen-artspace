const scheduleModal = new bootstrap.Modal(
    document.getElementById("scheduleModal")
);
const modalTitle = document.getElementById("modalTitle");
const scheduleForm = document.getElementById("scheduleForm");
const validationErrors = document.getElementById("validationErrors");
const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
const statusField = document.getElementById("status");

function clearErrors() {
    validationErrors.innerHTML = "";
    validationErrors.classList.add("d-none");
}

// activitySchedule.js

function openAddModal() {
    scheduleForm.reset();
    clearErrors();
    modalTitle.textContent = "Add New Schedule";
    statusField.parentElement.classList.remove("d-none");
    scheduleForm.setAttribute("data-action-type", "add");
    scheduleModal.show();
}

function openEditModal(id) {
    // Fetch sudah benar, karena menggunakan URL dinamis
    fetch(`/admin/activity-schedules/${id}/edit`)
        .then((response) => response.json())
        .then((data) => {
            scheduleForm.reset();
            clearErrors();
            modalTitle.textContent = "Edit Schedule";
            statusField.parentElement.classList.remove("d-none");
            scheduleForm.setAttribute("data-action-type", "edit");
            scheduleForm.setAttribute("data-id", id);

            document.getElementById("date").value = data.date.substring(0, 10);
            document.getElementById("time").value = data.time.substring(0, 5);
            document.getElementById("activity").value = data.activity;
            document.getElementById("location").value = data.location;
            document.getElementById("price").value = data.price;
            document.getElementById("max_participants").value =
                data.max_participants;
            document.getElementById("status").value = data.status;
            document.getElementById("description").value =
                data.description || "";

            scheduleModal.show();
        })
        .catch((error) => console.error("Error loading edit data:", error));
}

scheduleForm.addEventListener("submit", function (event) {
    event.preventDefault();
    const actionType = this.getAttribute("data-action-type");
    const id = this.getAttribute("data-id");

    // PERBAIKAN KRUSIAL: Ambil URL dari data-attribute, JANGAN gunakan Blade di JS
    let url = this.dataset.storeUrl;

    const formData = new FormData(this);

    if (actionType === "edit") {
        url = `/admin/activity-schedules/${id}`; // URL untuk update sudah benar
        formData.append("_method", "PUT");
    } else {
        formData.delete("status");
    }

    fetch(url, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            Accept: "application/json",
        },
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
                scheduleModal.hide();
                // Lebih baik jangan alert, tapi gunakan notifikasi yang lebih modern jika ada
                alert(data.success);
                location.reload();
            }
        })
        .catch((errorData) => {
            console.error("Submit Error:", errorData);
            if (errorData.errors) {
                let errorMessages = "<ul>";
                // Menangani error dari validasi konflik jadwal
                if (errorData.errors.activity) {
                    errorMessages += `<li>${errorData.errors.activity[0]}</li>`;
                }
                for (const key in errorData.errors) {
                    if (key !== "activity") {
                        // Hindari duplikasi pesan error
                        errorMessages += `<li>${errorData.errors[key][0]}</li>`;
                    }
                }
                errorMessages += "</ul>";
                validationErrors.innerHTML = errorMessages;
                validationErrors.classList.remove("d-none");
            } else {
                alert(
                    errorData.message ||
                        "An unexpected error occurred. Check the console for details."
                );
            }
        });
});

function deleteSchedule(id) {
    if (confirm("Are you sure you want to delete this schedule?")) {
        // Fetch delete sudah benar
        fetch(`/admin/activity-schedules/${id}`, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": csrfToken, Accept: "application/json" },
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
}

function showParticipants(scheduleId) {
    window.location.href = `/admin/activity-schedules/${scheduleId}/participants`;
}
