document.addEventListener("DOMContentLoaded", function () {
    //
    // --- STEP 2 LOGIC (Activity, Date, Time) ---
    //
    const activitySelect = document.getElementById("activitySelect");
    const dateInputWrapper = document.getElementById("dateInputWrapper");
    const dateInput = document.getElementById("dateInput");
    const timeInputWrapper = document.getElementById("timeInputWrapper");
    const timeInput = document.getElementById("timeInput");
    const step3Content = document.getElementById("step3Content");

    function toggleDateInputVisibility() {
        if (activitySelect && activitySelect.value !== "") {
            dateInputWrapper.classList.remove("hidden");
        } else {
            if (dateInputWrapper) dateInputWrapper.classList.add("hidden");
            if (dateInput) dateInput.value = "";
            if (timeInputWrapper) timeInputWrapper.classList.add("hidden");
            if (timeInput) timeInput.value = "";
        }
    }

    function toggleTimeInputVisibility() {
        if (dateInput && dateInput.value !== "") {
            if (timeInputWrapper) timeInputWrapper.classList.remove("hidden");
        } else {
            if (timeInputWrapper) timeInputWrapper.classList.add("hidden");
            if (timeInput) timeInput.value = "";
        }
    }

    function toggleStep3ContentVisibility() {
        if (
            activitySelect &&
            dateInput &&
            timeInput &&
            activitySelect.value !== "" &&
            dateInput.value !== "" &&
            timeInput.value !== ""
        ) {
            if (step3Content) step3Content.classList.remove("hidden");
        } else {
            if (step3Content) step3Content.classList.add("hidden");
        }
    }

    if (activitySelect) {
        activitySelect.addEventListener("change", function () {
            toggleDateInputVisibility();
            toggleTimeInputVisibility();
            toggleStep3ContentVisibility();
        });
    }

    if (dateInput) {
        dateInput.addEventListener("change", function () {
            toggleTimeInputVisibility();
            toggleStep3ContentVisibility();
        });
    }

    if (timeInput) {
        timeInput.addEventListener("change", toggleStep3ContentVisibility);
    }

    //
    // --- COPY ACCOUNT BUTTON LOGIC ---
    //
    const copyAccountBtn = document.querySelector(".copy-account-btn");
    if (copyAccountBtn) {
        copyAccountBtn.addEventListener("click", function () {
            const accountNumber = "6485277068";
            navigator.clipboard
                .writeText(accountNumber)
                .then(() => {
                    alert("Nomor rekening berhasil disalin: " + accountNumber);
                })
                .catch((err) => {
                    console.error("Gagal menyalin nomor rekening: ", err);
                });
        });
    }

    //
    // --- SHOW EVIDENCE LOGIC ---
    //
    window.showEvidence = function (src) {
        const img = document.getElementById("modalEvidenceImage");
        const downloadBtn = document.getElementById("downloadEvidenceBtn");
        if (img) img.src = src;
        if (downloadBtn) downloadBtn.href = src;
    };

    //
    // --- EDIT BUTTONS LOGIC ---
    //
    const editButtons = document.querySelectorAll(".btn-edit-activity");
    editButtons.forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const id = row.querySelector("td:nth-child(1)").textContent.trim();
            const activity = row
                .querySelector("td:nth-child(2)")
                .textContent.trim();

            document.getElementById("edit-activity-id").value = id;
            document.getElementById("edit-activity-name").value = activity;
        });
    });

    //
    // --- PARTICIPANT SEARCH LOGIC ---
    //
    const registrationForm = document.getElementById("registrationForm");
    const participantNameInput = document.getElementById("participantName");
    const nextButton = document.getElementById("nextButton");
    const searchResultsDiv = document.getElementById("searchResults");
    const loadingMessage = document.getElementById("loadingMessage");
    const resultsList = document.getElementById("resultsList");
    const noResultsMessage = document.getElementById("noResultsMessage");
    const selectedParticipantDetails = document.getElementById(
        "selectedParticipantDetails"
    );

    const dummyParticipantData = [
        {
            id: 1,
            name: "Meyza Patricia",
            activity: "Clay Painting",
        },
        {
            id: 2,
            name: "Meyza Kristina",
            activity: "Pottery Class",
        },
        {
            id: 3,
            name: "Jessica Meyza",
            activity: "Water Coloring",
        },
        {
            id: 4,
            name: "Budi Santoso",
            activity: "Clay Painting",
        },
        {
            id: 5,
            name: "Dewi Melati",
            activity: "Sculpture Workshop",
        },
    ];

    if (registrationForm) {
        registrationForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const query = participantNameInput.value.toLowerCase().trim();

            searchResultsDiv.classList.add("hidden");
            selectedParticipantDetails.classList.add("hidden");

            if (query.length > 0) {
                loadingMessage.classList.remove("hidden");

                setTimeout(() => {
                    loadingMessage.classList.add("hidden");

                    const filteredResults = dummyParticipantData.filter(
                        (item) => item.name.toLowerCase().includes(query)
                    );

                    if (filteredResults.length > 0) {
                        displayResults(filteredResults);
                        searchResultsDiv.classList.remove("hidden");
                    } else {
                        noResultsMessage.classList.remove("hidden");
                        searchResultsDiv.classList.remove("hidden");
                    }
                }, 300);
            } else {
                alert("Nama peserta tidak boleh kosong.");
                resultsList.innerHTML = "";
                noResultsMessage.classList.add("hidden");
                searchResultsDiv.classList.add("hidden");
            }
        });
    }

    function displayResults(results) {
        resultsList.innerHTML = "";
        noResultsMessage.classList.add("hidden");

        results.forEach((item) => {
            const li = document.createElement("li");
            li.className = "list-group-item list-group-item-action";
            li.textContent = `${item.name} (${item.activity})`;
            li.dataset.id = item.id;

            // Logika baru: mengalihkan ke route '/' saat list diklik
            li.addEventListener("click", function () {
                window.location.href = "/finishScan";
            });

            resultsList.appendChild(li);
        });
    }

    function selectParticipant(participant) {
        document.getElementById("selectedName").textContent = participant.name;
        document.getElementById("selectedActivity").textContent =
            participant.activity;

        selectedParticipantDetails.classList.remove("hidden");
        searchResultsDiv.classList.add("hidden");

        nextButton.textContent = "NEXT";
        nextButton.disabled = false;
        nextButton.type = "button";
        nextButton.onclick = function () {
            alert("Pencarian berhasil. Tombol NEXT diaktifkan.");
        };

        participantNameInput.value = participant.name;
    }
});
