document.addEventListener("DOMContentLoaded", () => {

    const urlParams = new URLSearchParams(window.location.search);
        const section = urlParams.get('section');
    
        // Check if the section is 'achievements' and trigger the loading of the section dynamically
        if (section === 'internships') {
            const internshipsTab = document.getElementById('internshipsTab');
            if (internshipsTab) {
                internshipsTab.click(); // Simulate a click to load the content dynamically
            }
        }
    
        // Form submission for adding achievements (handles the modal form)
        const addInternshipForm = document.getElementById('addInternshipForm');
        if (addInternshipForm) {
            addInternshipForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission behavior
                const formData = new FormData(addInternshipForm);
    
                // Submit the form using AJAX
                fetch(addInternshipForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            // Close the modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('addInternshipModal'));
                            modal.hide();
    
                            // Refresh the achievements section
                            document.getElementById('main-content').load(internshipIndexRoute, function () {
                                // Highlight the achievements tab
                                document.querySelectorAll('.ajax-link').forEach((link) => link.classList.remove('active'));
                                document.querySelector(`[data-url="{{ route('internships.index') }}"]`).classList.add('active');
                            });
                        } else {
                            alert('Failed to save. Please try again.');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        alert('An error occurred while saving');
                    });
            });
        }
    
    // Edit Button
    $(document).on('click', '.edit-btn', function () {
        const internshipId = $(this).data('id');
    
        // Make an AJAX request to fetch the details
        $.ajax({
            url: `/internships/${internshipId}`, // Ensure the route is defined in web.php
            type: 'GET',
            success: function (response) {
                // Populate the edit form with the fetched data
                $('#editCompanyName').val(response.company_name);
                $('#editEmail').val(response.email);
                $('#editStartDate').val(response.start_date);
                $('#editEndDate').val(response.end_date);
                $('#editStatus').val(response.status);
                $('#editForm').attr('action', `/internships/${internshipId}`);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching internship details:', error);
            }
        });
    });
        // Delete Button
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const internshipId = e.target.closest('button').getAttribute('data-id');
            if (confirm("Are you sure you want to delete this internship?")) {
                // Perform AJAX request or form submission for deletion
                deleteInternship(internshipId);
            }
        });
    });
});

function deleteInternship(internshipId) {
    fetch(`/internships/${internshipId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    })
    .then(response => {
        if (response.ok) {
            alert("Internship deleted successfully.");
            location.reload(); // Reload the page to reflect the deletion
        } else {
            alert("Failed to delete internship.");
        }
    });
}
