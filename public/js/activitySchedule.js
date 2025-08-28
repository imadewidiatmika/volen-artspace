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

function openAddModal() {
    scheduleForm.reset();
    clearErrors();
    modalTitle.textContent = "Add New Schedule";
    statusField.parentElement.classList.add("d-none");
    scheduleForm.setAttribute("data-action-type", "add");
    scheduleModal.show();
}

function openEditModal(id) {
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
    let url = "{{ route('admin.activity-schedules.store') }}";
    const formData = new FormData(this);

    if (actionType === "edit") {
        url = `/admin/activity-schedules/${id}`;
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
                // Jika response error (misal: validasi 422)
                // 'data' akan berisi pesan error dari Laravel
                throw data;
            }
            // Jika response sukses (status 2xx)
            // 'data' akan berisi pesan sukses dari Laravel
            return data;
        })
        .then((data) => {
            // Ini hanya berjalan jika fetch SUKSES
            if (data.success) {
                scheduleModal.hide();
                alert(data.success);
                location.reload();
            }
        })
        .catch((errorData) => {
            // Blok ini menangani SEMUA jenis error
            console.error("Submit Error:", errorData); // Tampilkan detail error di console
            if (errorData.errors) {
                // Jika ini adalah error validasi dari Laravel
                let errorMessages = "<ul>";
                for (const key in errorData.errors) {
                    errorMessages += `<li>${errorData.errors[key][0]}</li>`;
                }
                errorMessages += "</ul>";
                validationErrors.innerHTML = errorMessages;
                validationErrors.classList.remove("d-none");
            } else {
                // Untuk error lainnya
                alert(
                    errorData.message ||
                        "An unexpected error occurred. Check the console for details."
                );
            }
        });
});

function deleteSchedule(id) {
    if (confirm("Are you sure you want to delete this schedule?")) {
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
