<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data Management Dashboard</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/achievements.css') }}">
    <link rel="stylesheet" href="{{ asset('css/internships.css') }}">
    <link rel="stylesheet" href="{{ asset('css/courses_workshops.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paper_publications.css') }}">


    <script>
        $(document).ready(function () {
        $('.ajax-link').on('click', function (e) {
            e.preventDefault();
            const url = $(this).data('url');

            // Remove active class from all links and add it to the clicked link
            $('.ajax-link').removeClass('active');
            $(this).addClass('active');

            // Fetch and load the content
            $('#main-content').load(url, function (response, status, xhr) {
                if (status === "error") {
                    $('#main-content').html('<div class="alert alert-danger">Error loading content. Please try again later.</div>');
                }
            });
        });
        });

    </script>
    


</head>
<body>


    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="sidebar bg-navy text-white d-flex flex-column justify-content-between">
            <div>
                <h3 class="sidebar-title">Dashboard</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link ajax-link" data-url="{{ route('achievements.index',['section' => 'achievements']) }}" id="achievementsTab">
                            <i class="fas fa-trophy"></i> Student Achievements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link ajax-link" data-url="{{ route('internships.index',['section' => 'internships']) }}" id="internshipsTab">
                            <i class="fas fa-briefcase"></i> Student Internships
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link ajax-link" data-url="{{ route('courses_workshops.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i> Student Courses & Workshops
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link ajax-link" data-url="{{ route('paper_publications.index') }}">
                            <i class="fas fa-file-alt"></i> Student Paper Publications
                        </a>
                    </li>
                </ul>
            </div>
            <div class="logout-container text-center mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>



        <!-- Main Content -->
        <div class="main-content bg-light" id="main-content">
            <div class="text-center">
                <h2 class="text-navy">Welcome to the Student Data Management System</h2>
                <p class="text-blue">Select a module from the left to manage your data effectively.</p>
                <img width="600" height="200" src="data:image/jpeg;base64,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" class="img-fluid rounded" alt="Welcome Image">
            </div>
        </div>
    </div>





    <script>
        const achivementIndexRoute='{{ route('achievements.index') }}';
    </script>
    <script src="{{ asset('js/studentAchievements.js') }}"></script>
    <script src="{{ asset('js/searchAchievements.js') }}"></script>
 

        
    <script src="{{ asset('js/internships.js') }}"></script>
    <script src="{{ asset('js/searchInternships.js') }}"></script>



    <script>
        const internshipIndexRoute='{{ route('internships.index') }}';
        const internshipsIndexUrl = "{{ route('internships.index') }}";
        const internshipsAjaxUrl = "{{ route('internships.ajax') }}";
    </script>


    <script src="{{ asset('js/courses_workshops.js') }}"></script>

    <script src="{{ asset('js/paper_publications.js') }}"></script>
    

</body>
</html>
