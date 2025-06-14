    // Populate the edit modal with data
    document.addEventListener("DOMContentLoaded", () => {
    // Edit Button
    $(document).on('click', '.edit-publication-btn', function () {
        const ppId = $(this).data('id');
    
        // Make an AJAX request to fetch the details
        $.ajax({
            url: `/paper_publications/${ppId}`, // Ensure the route is defined in web.php
            type: 'GET',
            success: function (response) {
                // Populate the edit form with the fetched data
                $('#editTitle').val(response.title);
                $('#editAuthors').val(response.authors);
                $('#editJournalName').val(response.journal_name);
                $('#editPublicationDate').val(response.publication_date);
                $('#editPublicationForm').attr('action', `/paper_publications/${ppId}`);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching internship details:', error);
            }
        });
    });

    });