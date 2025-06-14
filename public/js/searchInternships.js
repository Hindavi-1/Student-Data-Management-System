
function initializeSearchInternships() {
    const searchInput = document.getElementById("searchInternships");

    if (!searchInput) {
        console.warn("Search input not found. Waiting for content to load...");
        return;
    }

    console.log("Search functionality initialized.");

    // Attach the filter function dynamically
    searchInput.addEventListener("input", filterInternships);
}


function filterInternships() {
    const query = document
        .getElementById("searchInternships")
        .value.toLowerCase();
    const internshipItems = document.querySelectorAll(".internship-row");

    internshipItems.forEach((item) => {
        const company_name = item.querySelector("[data-company-name]")?.dataset.company_name || "";
        const status = item.querySelector("[data-status]")?.dataset.status || "";
        console.log("Company Name:", company_name);
        console.log("Company:", item.querySelector("[data-company-name]").dataset.company_name);
        console.log("Status",status)

        if (company_name.includes(query) || status.includes(query)) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    });

    const visibleItems = Array.from(internshipItems).filter(
        (item) => item.style.display !== "none"
    );
    const noDataMessage = document.querySelector(".no-data-message");

    if (visibleItems.length === 0) {
        if (!noDataMessage) {
            const message = document.createElement("p");
            message.className = "no-data-message text-center mt-4";
            message.innerText = "No internships match your search.";
            document.getElementById("internshipsContainer").appendChild(message);
        }
    } else {
        if (noDataMessage) {
            noDataMessage.remove();
        }
    }
}

// Attach the function to dynamically loaded content
document.addEventListener("DOMContentLoaded", () => {
    const mainContent = document.getElementById("main-content");
    if (mainContent) {
        const observer = new MutationObserver(() => {
            initializeSearchInternships();
        });

        observer.observe(mainContent, { childList: true, subtree: true });
    }
});

