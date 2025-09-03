function showEvidence(src) {
    const modalImage = document.getElementById("modalEvidenceImage");
    if (modalImage) {
        modalImage.src = src;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const filterCard = document.getElementById("registrants-filter-card");
    if (!filterCard) return;

    const getDatesUrl = filterCard.dataset.getDatesUrl;
    const getTimesUrl = filterCard.dataset.getTimesUrl;
    const getDataUrl = filterCard.dataset.getDataUrl;

    const activitySelect = document.getElementById("activitySelect");
    const dateSelect = document.getElementById("dateSelect");
    const timeSelect = document.getElementById("timeSelect");
    const locationText = document.getElementById("locationText");
    const statusText = document.getElementById("statusText");
    const seeAttendantsButton = document.getElementById("seeAttendantsButton");
    const tableBody = document.getElementById("registrants-table-body");
    const paginationInfo = document.getElementById("pagination-info");
    const searchInput = document.getElementById("searchInput");
    const perPageSelect = document.getElementById("perPageSelect");
    const paginationLinks = document.getElementById("pagination-links");

    function resetSelect(select, defaultText = "Select an option") {
        select.innerHTML = `<option value="">${defaultText}</option>`;
        select.disabled = true;
    }

    activitySelect.addEventListener("change", async function () {
        const activityId = this.value;
        resetSelect(dateSelect, "Loading dates...");
        resetSelect(timeSelect, "Select date first");
        locationText.textContent = "-";
        statusText.textContent = "-";
        seeAttendantsButton.disabled = true;
        if (!activityId) {
            resetSelect(dateSelect, "Select activity first");
            return;
        }
        try {
            const response = await fetch(
                `${getDatesUrl}?activity_id=${activityId}`
            );
            const dates = await response.json();
            resetSelect(dateSelect, "Select Date");
            dates.forEach(
                (date) =>
                    (dateSelect.innerHTML += `<option value="${date.value}">${date.text}</option>`)
            );
            dateSelect.disabled = false;
        } catch (error) {
            console.error("Error fetching dates:", error);
            resetSelect(dateSelect, "Error loading dates");
        }
    });

    dateSelect.addEventListener("change", async function () {
        const activityId = activitySelect.value;
        const selectedDate = this.value;
        resetSelect(timeSelect, "Loading times...");
        locationText.textContent = "-";
        statusText.textContent = "-";
        seeAttendantsButton.disabled = true;
        if (!selectedDate) {
            resetSelect(timeSelect, "Select date first");
            return;
        }
        try {
            const response = await fetch(
                `${getTimesUrl}?activity_id=${activityId}&date=${selectedDate}`
            );
            const times = await response.json();
            resetSelect(timeSelect, "Select Time");
            times.forEach(
                (schedule) =>
                    (timeSelect.innerHTML += `<option value="${schedule.id}" data-location="${schedule.location}" data-status="${schedule.status}">${schedule.time}</option>`)
            );
            timeSelect.disabled = false;
        } catch (error) {
            console.error("Error fetching times:", error);
            resetSelect(timeSelect, "Error loading times");
        }
    });

    timeSelect.addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];
        if (!this.value) {
            locationText.textContent = "-";
            statusText.textContent = "-";
            seeAttendantsButton.disabled = true;
            return;
        }
        locationText.textContent = selectedOption.dataset.location;
        statusText.textContent = selectedOption.dataset.status;
        seeAttendantsButton.disabled = false;
    });

    async function fetchRegistrants(url) {
        if (!url) return;
        tableBody.innerHTML =
            '<tr><td colspan="8" class="text-center text-muted py-4">Loading data...</td></tr>';
        try {
            const response = await fetch(url);
            if (!response.ok)
                throw new Error(`HTTP error! status: ${response.status}`);
            const result = await response.json();
            updateTable(result.data);
            updatePaginationInfo(result);
            renderPagination(result.links);
        } catch (error) {
            console.error("Fetch error:", error);
            tableBody.innerHTML =
                '<tr><td colspan="8" class="text-center text-danger py-4">Failed to load data. Please check the console.</td></tr>';
        }
    }

    function updateTable(registrants) {
        tableBody.innerHTML = "";
        if (!registrants || registrants.length === 0) {
            tableBody.innerHTML =
                '<tr><td colspan="8" class="text-center text-muted py-4">No attendants found.</td></tr>';
            return;
        }
        registrants.forEach((reg) => {
            if (!reg) return; // Skip null entries
            const receiptHtml = reg.receipt_url
                ? `<a href="#" onclick="showEvidence('${reg.receipt_url}')" data-bs-toggle="modal" data-bs-target="#evidenceModal"><div class="receipt-thumbnail"><img src="${reg.receipt_url}" alt="Receipt"></div></a>`
                : '<span class="text-muted">N/A</span>';

            const statusBadge = `<span class="badge bg-info-lt">${reg.status}</span>`;

            const row = `
                <tr>
                    <td><span class="text-muted">${reg.participant_id
                        .substring(0, 8)
                        .toUpperCase()}</span></td>
                    <td>${reg.name}</td><td>${reg.phone}</td>
                    <td><a href="mailto:${reg.email}">${reg.email}</a></td>
                    <td>${
                        reg.country
                    }</td><td><span class="badge bg-secondary-lt">${
                reg.remark
            }</span></td>
                    <td>${receiptHtml}</td><td>${statusBadge}</td>
                </tr>`;
            tableBody.innerHTML += row;
        });
    }

    function updatePaginationInfo(result) {
        paginationInfo.textContent =
            !result || result.total === 0
                ? "Showing 0 of 0 entries"
                : `Showing ${result.from} to ${result.to} of ${result.total} entries`;
    }

    function renderPagination(links) {
        paginationLinks.innerHTML = "";
        if (!links) return;
        const ul = document.createElement("ul");
        ul.className = "pagination m-0";
        links.forEach((link) => {
            const li = document.createElement("li");
            li.className = `page-item ${link.active ? "active" : ""} ${
                !link.url ? "disabled" : ""
            }`;
            const a = document.createElement("a");
            a.className = "page-link";
            a.href = "#";
            a.innerHTML = link.label;
            if (link.url) a.dataset.url = link.url;
            li.appendChild(a);
            ul.appendChild(li);
        });
        paginationLinks.appendChild(ul);
    }

    function buildApiUrl(page = 1) {
        const scheduleId = timeSelect.value;
        const search = searchInput.value;
        const perPage = perPageSelect.value;
        if (!scheduleId) return null;
        let url = new URL(getDataUrl);
        url.searchParams.append("schedule_id", scheduleId);
        url.searchParams.append("page", page);
        if (search) url.searchParams.append("search", search);
        if (perPage) url.searchParams.append("per_page", perPage);
        return url.toString();
    }

    seeAttendantsButton.addEventListener("click", () =>
        fetchRegistrants(buildApiUrl(1))
    );
    searchInput.addEventListener("keyup", (event) => {
        if (event.key === "Enter") seeAttendantsButton.click();
    });
    perPageSelect.addEventListener("change", () => {
        if (timeSelect.value) fetchRegistrants(buildApiUrl(1));
    });
    paginationLinks.addEventListener("click", function (event) {
        event.preventDefault();
        const target = event.target.closest("a");
        if (target && target.dataset.url) {
            const url = new URL(target.dataset.url);
            const search = searchInput.value;
            const perPage = perPageSelect.value;
            if (search) url.searchParams.append("search", search);
            if (perPage) url.searchParams.append("per_page", perPage);
            fetchRegistrants(url.toString());
        }
    });
});
