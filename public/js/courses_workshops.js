document.addEventListener("DOMContentLoaded", function () {
    const addEditForm = document.getElementById("addEditCourseWorkshopForm");
    const formMethodInput = document.getElementById("form-method");
    const formIdInput = document.getElementById("form-id");

    // Add New Button
    document.getElementById("addNewBtn").addEventListener("click", function () {
        addEditForm.action = "/courses_workshops";
        formMethodInput.value = "POST"; // Reset method to POST
        formIdInput.value = ""; // Clear ID
        addEditForm.reset(); // Clear all inputs
        document.getElementById("addEditCourseWorkshopModalLabel").innerText = "Add New Course or Workshop";
    });

    // Edit Button
    document.querySelectorAll(".edit-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const organizer = this.dataset.organizer;
            const startDate = this.dataset["start-date"];
            const endDate = this.dataset["end-date"];
            const type = this.dataset.type;
            const mode = this.dataset.mode;

            addEditForm.action = `/courses_workshops/${id}`;
            formMethodInput.value = "PUT"; // Update method to PUT
            formIdInput.value = id;

            document.getElementById("form-title").value = title;
            document.getElementById("form-organizer").value = organizer;
            document.getElementById("form-start-date").value = startDate;
            document.getElementById("form-end-date").value = endDate || "";
            document.getElementById("form-type").value = type;
            document.getElementById("form-mode").value = mode;

            document.getElementById("addEditCourseWorkshopModalLabel").innerText = "Edit Course or Workshop";
        });
    });
});
