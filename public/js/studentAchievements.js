
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const section = urlParams.get('section');

    // Check if the section is 'achievements' and trigger the loading of the section dynamically
    if (section === 'achievements') {
        const achievementsTab = document.getElementById('achievementsTab');
        if (achievementsTab) {
            achievementsTab.click(); // Simulate a click to load the content dynamically
        }
    }

    // Form submission for adding achievements (handles the modal form)
    const addAchievementForm = document.getElementById('addAchievementForm');
    if (addAchievementForm) {
        addAchievementForm.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission behavior
            const formData = new FormData(addAchievementForm);

            // Submit the form using AJAX
            fetch(addAchievementForm.action, {
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
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addAchievementModal'));
                        modal.hide();

                        // Refresh the achievements section
                        document.getElementById('main-content').load(achivementIndexRoute, function () {
                            // Highlight the achievements tab
                            document.querySelectorAll('.ajax-link').forEach((link) => link.classList.remove('active'));
                            document.querySelector(`[data-url="{{ route('achievements.index') }}"]`).classList.add('active');
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
});
