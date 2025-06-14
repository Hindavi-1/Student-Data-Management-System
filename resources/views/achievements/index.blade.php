<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="section-title text-primary">🎓 Student Achievements</h2>
            <p class="section-subtitle text-muted">Explore and manage the achievements below.</p>
        </div>
        <button class="btn btn-primary btn-lg add-btn" data-bs-toggle="modal" data-bs-target="#addAchievementModal">
            <i class="fas fa-plus-circle"></i> Add Achievement
        </button>
    </div>


    <!-- Search achievements -->
    <div class="input-group mb-4">
        <input type="text" id="searchAchievements" class="form-control" placeholder="Search achievements..." onkeyup="filterAchievements()">
        <span class="input-group-text">
            <i class="fas fa-search"></i>
        </span>
    </div>


    <!-- Display achievements -->
    <div class="row g-3" id="achievementsContainer">
        @if ($achievements->isEmpty())
            <div class="col-12 text-center">
                <p class="no-data-message">No achievements added yet. Click "Add Achievement" to create one.</p>
            </div>
        @else
            @foreach ($achievements as $achievement)
                <div class="col-md-4">
                    <div class="card achievement-card shadow-sm">
                        <div class="card-body">
                            <div class="icon-container">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <h5 class="card-title" data-title="{{ strtolower($achievement->title) }}" >{{ $achievement->title }}</h5>
                            <p class="card-text" data-description="{{ strtolower($achievement->description) }}">{{ $achievement->description }}</p>
                            <div class="achievement-details">
                                <small>
                                    <strong>Awarded on:</strong> {{ \Carbon\Carbon::parse($achievement->date_awarded)->format('d M Y') }}<br>
                                    <strong>Type:</strong> {{ $achievement->type }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>


 <!-- Add Achievement Modal -->
<div class="modal fade" id="addAchievementModal" tabindex="-1" aria-labelledby="addAchievementLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0">
            <form id="addAchievementForm" action="{{ route('achievements.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addAchievementLabel"><i class="fas fa-plus-circle"></i> Add Achievement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Title -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Achievement Title" required>
                                <label for="title"><i class="fas fa-trophy text-primary"></i> Achievement Title</label>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea class="form-control" id="description" name="description" rows="6" placeholder="Description" required></textarea>
                                <label for="description"><i class="fas fa-align-left text-primary"></i> Description</label>
                            </div>
                        </div>
                        <!-- Date Awarded -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="date_awarded" name="date_awarded" required>
                                <label for="date_awarded"><i class="fas fa-calendar-alt text-primary"></i> Date Awarded</label>
                            </div>
                        </div>
                        <!-- Type -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Select Type of Achievement</option>
                                    <option value="Academic">Academic</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Cultural">Cultural</option>
                                    <option value="Other">Other</option>
                                </select>
                                <label for="type"><i class="fas fa-tag text-primary"></i> Achievement Type</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-gradient"><i class="fas fa-save"></i> Save Achievement</button>
                </div>
            </form>
        </div>
    </div>
</div>
