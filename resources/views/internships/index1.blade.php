<div class="container py-4">
    <h2 class="text-center text-navy mb-4">Student Internships</h2>
    
    <!-- Add Internship Button -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addInternshipModal">
            <i class="fas fa-plus"></i> Add Internship
        </button>
    </div>

    <!-- Internships Table -->
        <table class="table table-striped">
            <thead>
                <tr>
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
                <!-- Rows will be added dynamically here -->
            </tbody>
        </table>

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




<!-- Edit Internship Modal -->
<div class="modal fade" id="editInternshipModal" tabindex="-1" aria-labelledby="editInternshipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editInternshipForm" action="{{ route('internships.update',  ['id'=>$internship->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="editInternshipModalLabel">Edit Internship</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-custom">
                    <!-- Hidden ID Field for Updating -->
                    <input type="hidden" id="editInternshipId" name="internship_id">
                    
                    <!-- Company Name -->
                    <div class="mb-3">
                        <label for="editCompanyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="editCompanyName" name="company_name" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" placeholder="Email Address" required>
                    </div>
                    <!-- Start Date -->
                    <div class="mb-3">
                        <label for="editStartDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="editStartDate" name="start_date" required>
                    </div>
                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="editEndDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="editEndDate" name="end_date" required>
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select class="form-select" id="editStatus" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
