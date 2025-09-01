document.addEventListener("DOMContentLoaded", function () {
    const registrationForm = document.getElementById("registrationForm");

    // Pastikan kode hanya berjalan jika form registrasi ada di halaman ini
    if (!registrationForm) {
        return;
    }

    // Ambil elemen-elemen DOM
    const activitySelect = document.getElementById("activitySelect");
    const dateWrapper = document.getElementById("dateWrapper");
    const dateSelect = document.getElementById("dateSelect");
    const timeWrapper = document.getElementById("timeWrapper");
    const timeSelect = document.getElementById("timeSelect");
    const detailsWrapper = document.getElementById("detailsWrapper");
    const locationText = document.querySelector("#locationText span");
    const priceText = document.querySelector("#priceText span");
    const nextButton = document.getElementById("nextButton");
    const loader = document.getElementById("loader");

    // Ambil URL dari data-attributes yang kita pasang di tag <form>
    const getDatesUrl = registrationForm.dataset.getDatesUrl;
    const getTimesUrl = registrationForm.dataset.getTimesUrl;
    const nextStepBaseUrl = registrationForm.dataset.nextStepBaseUrl;

    function resetAndHide(elements) {
        elements.forEach((el) => el.classList.add("hidden"));
    }

    // 1. Saat Aktivitas dipilih
    activitySelect.addEventListener("change", function () {
        const activityId = this.value;
        resetAndHide([dateWrapper, timeWrapper, detailsWrapper]);
        dateSelect.innerHTML = "";
        timeSelect.innerHTML = "";

        if (!activityId) return;

        loader.classList.remove("hidden");

        fetch(`${getDatesUrl}?activity_id=${activityId}`)
            .then((response) => response.json())
            .then((data) => {
                loader.classList.add("hidden");
                dateSelect.innerHTML =
                    '<option value="" selected disabled>Select Date</option>';
                data.forEach((date) => {
                    dateSelect.innerHTML += `<option value="${date.value}">${date.text}</option>`;
                });
                dateWrapper.classList.remove("hidden");
            });
    });

    // 2. Saat Tanggal dipilih
    dateSelect.addEventListener("change", function () {
        const activityId = activitySelect.value;
        const selectedDate = this.value;
        resetAndHide([timeWrapper, detailsWrapper]);
        timeSelect.innerHTML = "";

        if (!selectedDate) return;

        loader.classList.remove("hidden");

        fetch(`${getTimesUrl}?activity_id=${activityId}&date=${selectedDate}`)
            .then((response) => response.json())
            .then((data) => {
                loader.classList.add("hidden");
                timeSelect.innerHTML =
                    '<option value="" selected disabled>Select Time</option>';
                data.forEach((schedule) => {
                    timeSelect.innerHTML += `<option value="${schedule.schedule_id}" data-location="${schedule.location}" data-price="${schedule.price}">${schedule.time_text}</option>`;
                });
                timeWrapper.classList.remove("hidden");
            });
    });

    // 3. Saat Waktu dipilih
    timeSelect.addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];
        const scheduleId = this.value;

        if (!scheduleId) {
            resetAndHide([detailsWrapper]);
            return;
        }

        const location = selectedOption.dataset.location;
        const price = selectedOption.dataset.price;

        locationText.textContent = location;
        priceText.textContent = price;

        // Atur link untuk tombol NEXT
        nextButton.href = `${nextStepBaseUrl}/${scheduleId}`;

        detailsWrapper.classList.remove("hidden");
    });
});
