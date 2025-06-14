function initializeSearchAchievements() {
    const searchInput = document.getElementById("searchAchievements");

    if (!searchInput) {
        console.warn("Search input not found. Waiting for content to load...");
        return;
    }

    console.log("Search functionality initialized.");

    searchInput.addEventListener("input", filterAchievements);
}

function filterAchievements() {
    const query = document
        .getElementById("searchAchievements")
        .value.toLowerCase();
    const achievementItems = document.querySelectorAll(".achievement-card");

    achievementItems.forEach((item) => {
        const title = item.querySelector("[data-title]").dataset.title.toLowerCase();
        const description = item.querySelector("[data-description]").dataset.description.toLowerCase();

        if (title.includes(query) || description.includes(query)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });

    // Handle empty state when no items match the search
    const visibleItems = Array.from(achievementItems).filter(
        (item) => item.style.display !== "none"
    );
    const noDataMessage = document.querySelector(".no-data-message");

    if (visibleItems.length === 0) {
        if (!noDataMessage) {
            const message = document.createElement("p");
            message.className = "no-data-message text-center mt-4";
            message.innerText = "No achievements match your search.";
            document
                .getElementById("achievementsContainer")
                .appendChild(message);
        }
    } else {
        if (noDataMessage) {
            noDataMessage.remove();
        }
    }
}

// Attach the observer to detect when the content is dynamically loaded
document.addEventListener("DOMContentLoaded", () => {
    const mainContent = document.getElementById("main-content");
    if (mainContent) {
        const observer = new MutationObserver(() => {
            console.log("Content loaded in #main-content. Checking for search input...");
            initializeSearchAchievements(); // Reinitialize the search functionality
        });

        observer.observe(mainContent, { childList: true, subtree: true });
    }
});
