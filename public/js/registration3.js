document.addEventListener("DOMContentLoaded", function () {
    const uploadArea = document.getElementById("uploadArea");
    const receiptInput = document.getElementById("receiptInput");
    const imagePreview = document.getElementById("imagePreview");
    const uploadDefaultContent = document.getElementById(
        "uploadDefaultContent"
    );
    const accountNumberEl = document.getElementById("accountNumber");

    const initialButtons = document.getElementById("initialButtons");
    const finalButtons = document.getElementById("finalButtons");
    const copyButton = document.getElementById("copyButton");

    // Pastikan semua elemen ada sebelum menambahkan event listener
    if (!uploadArea || !receiptInput || !copyButton) {
        return;
    }

    const accountNumber = accountNumberEl ? accountNumberEl.textContent : "";

    uploadArea.addEventListener("click", () => receiptInput.click());

    receiptInput.addEventListener("change", function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                if (imagePreview) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove("d-none");
                }
                if (uploadDefaultContent) {
                    uploadDefaultContent.classList.add("d-none");
                }

                // Tukar visibilitas tombol
                if (initialButtons) initialButtons.classList.add("d-none");
                if (finalButtons) finalButtons.classList.remove("d-none");
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    copyButton.addEventListener("click", function () {
        if (!accountNumber) return;

        navigator.clipboard
            .writeText(accountNumber)
            .then(() => {
                alert("Account number copied: " + accountNumber);
            })
            .catch((err) => {
                console.error("Failed to copy: ", err);
            });
    });
});
