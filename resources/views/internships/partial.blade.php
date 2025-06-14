<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="section-title text-primary">🏢 Student Internships</h2>
            <p class="section-subtitle text-muted">Explore and manage the internships below.</p>
        </div>
        <button class="btn btn-primary btn-lg add-btn" data-bs-toggle="modal" data-bs-target="#addInternshipModal">
            <i class="fas fa-plus-circle"></i> Add Internship
        </button>
    </div>


    <!-- Search internships -->
    <div class="input-group mb-4">
        <input type="text" id="searchInternships" class="form-control" placeholder="Search Internships..." onkeyup="filterInternships()">
        <span class="input-group-text">
            <i class="fas fa-search"></i>
        </span>
    </div>


    <!-- Display achievements -->
    <div class="row g-3" id="internshipsContainer" style="margin: top 15px;">
        @if ($internships->isEmpty())
            <div class="col-12 text-center">
                <p class="no-data-message">No internships added yet. Click "Add Internship" to create one.</p>
            </div>
        @else
                <!-- Internships Table -->
            <table class="table table-hover table-bordered">
                <thead>
                    <tr class="table-dark">
                        <th>#</th>
                        <th>Email</th>
                        <th>Company Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="internshipsTableBody">
                    @php $index = 0; @endphp
                    @foreach ($internships as $internship)
                        <tr class="internship-row">
                            <td>{{ ++$index }}</td>
                            <td>{{ $internship->email }}</td>
                            <td data-company-name="{{ strtolower($internship->company_name) }}">{{ $internship->company_name }}</td>
                            <td>{{ $internship->start_date }}</td>
                            <td>{{ $internship->end_date }}</td>
                            <td data-status="{{ strtolower($internship->status) }}">{{ $internship->status }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $internship->id }}" data-bs-toggle="modal" data-bs-target="#editInternshipModal">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm delete-btn"   data-id="{{ $internship->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>



<!-- Add Internship Modal -->
<div class="modal fade" id="addInternshipModal" tabindex="-1" aria-labelledby="addInternshipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addInternshipForm" action="{{ route('internships.store') }}" method="POST">
                @csrf
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="addInternshipModalLabel">Add New Internship</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-custom">
                    <!-- Company Name -->
                    <div class="mb-3">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="companyName" name="company_name" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    </div>
                    <!-- Start Date -->
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="start_date" required>
                    </div>
                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="end_date" required>
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-secondary btn-close-custom" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-submit-custom">Add Internship</button>
                </div>
            </form>
        </div>
    </div>
</div>
