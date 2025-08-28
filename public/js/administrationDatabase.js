const adminModal = new bootstrap.Modal(document.getElementById("adminModal"));
const modalTitle = document.getElementById("modalTitle");
const adminForm = document.getElementById("adminForm");
const validationErrors = document.getElementById("validationErrors");
const passwordHint = document.getElementById("passwordHint");
const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

function clearErrors() {
    validationErrors.innerHTML = "";
    validationErrors.classList.add("d-none");
}

function openAddModal() {
    adminForm.reset();
    clearErrors();
    modalTitle.textContent = "Add New Administrator";
    passwordHint.classList.add("d-none");
    document.getElementById("password").required = true;
    adminForm.setAttribute("data-action-type", "add");
    adminModal.show();
}

function openEditModal(id) {
    fetch(`/admin/administrators/${id}/edit`)
        .then((response) => response.json())
        .then((data) => {
            adminForm.reset();
            clearErrors();
            modalTitle.textContent = "Edit Administrator";
            passwordHint.classList.remove("d-none");
            document.getElementById("password").required = false;
            adminForm.setAttribute("data-action-type", "edit");
            adminForm.setAttribute("data-id", id);

            document.getElementById("username").value = data.username;
            document.getElementById("identity_number").value =
                data.identity_number;
            document.getElementById("address").value = data.address || "";
            document.getElementById("phone_number").value =
                data.phone_number || "";
            document.getElementById("is_active").value = data.is_active
                ? "1"
                : "0";

            adminModal.show();
        })
        .catch((error) => console.error("Error loading edit data:", error));
}

adminForm.addEventListener("submit", function (event) {
    event.preventDefault();
    const actionType = this.getAttribute("data-action-type");
    const id = this.getAttribute("data-id");
    let url = "{{ route('admin.administrators.store') }}";
    const formData = new FormData(this);

    if (actionType === "edit") {
        url = `/admin/administrators/${id}`;
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
                adminModal.hide();
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

function deleteAdmin(id) {
    if (confirm("Are you sure you want to delete this administrator?")) {
        fetch(`/admin/administrators/${id}`, {
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
