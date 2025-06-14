<div class="container mt-4">
    <!-- <h1>Courses & Workshops</h1>
    
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCourseWorkshopModal">
        <i class="fas fa-plus"></i> Add New
    </button> -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="section-title text-primary">🛠️ Courses & Workshops</h2>
            <p class="section-subtitle text-muted">Explore and manage the Courses/Workshops below.</p>
        </div>
        <button class="btn btn-primary btn-lg add-btn" data-bs-toggle="modal" data-bs-target="#addCourseWorkshopModal">
            <i class="fas fa-plus-circle"></i> Add New
        </button>
    </div>



    <!-- Search  -->
    <div class="input-group mb-4">
        <input type="text" id="searchCourses" class="form-control" placeholder="Search Courses/Workshops..." onkeyup="filterCourses()">
        <span class="input-group-text">
            <i class="fas fa-search"></i>
        </span>
    </div>



<!-- Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Organizer</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Type</th>
            <th>Mode</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($coursesWorkshops as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>{{ $item->organizer }}</td>
            <td>{{ $item->start_date }}</td>
            <td>{{ $item->end_date ?: 'N/A' }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->mode }}</td>
            <td class="table-actions">
                <!-- Edit Button with data attributes for populating the modal -->
                <button class="btn btn-warning btn-sm edit-btn" 
                    data-id="{{ $item->id }}" 
                    data-title="{{ $item->title }}" 
                    data-organizer="{{ $item->organizer }}" 
                    data-start-date="{{ $item->start_date }}" 
                    data-end-date="{{ $item->end_date }}" 
                    data-type="{{ $item->type }}" 
                    data-mode="{{ $item->mode }}" 
                    data-bs-toggle="modal" 
                    data-bs-target="#addEditCourseWorkshopModal">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <!-- Delete Button -->
                <form action="{{ route('courses_workshops.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="no-data-message">No entries found. Add new data to get started!</td>
        </tr>
        @endforelse
    </tbody>
</table>
   </div>


 <!-- Modal for Adding New Course or Workshop -->
 <div class="modal fade" id="addCourseWorkshopModal" tabindex="-1" aria-labelledby="addCourseWorkshopModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseWorkshopModalLabel">Add New Course or Workshop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('courses_workshops.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter course/workshop title" required>
                        </div>
                        <div class="mb-3">
                            <label for="organizer" class="form-label">Organizer</label>
                            <input type="text" class="form-control" id="organizer" name="organizer" placeholder="Enter organizer name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="Course">Course</option>
                                <option value="Workshop">Workshop</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mode" class="form-label">Mode</label>
                            <select class="form-select" id="mode" name="mode" required>
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- Add/Edit Modal -->
<div class="modal fade" id="addEditCourseWorkshopModal" tabindex="-1" aria-labelledby="addEditCourseWorkshopModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEditCourseWorkshopModalLabel">Edit Course or Workshop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEditCourseWorkshopForm" method="POST">
                    @csrf
                    <input type="hidden" id="form-method" name="_method" value="POST">
                    <input type="hidden" id="form-id" name="id">
                    <div class="mb-3">
                        <label for="form-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="form-title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="form-organizer" class="form-label">Organizer</label>
                        <input type="text" class="form-control" id="form-organizer" name="organizer" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="form-start-date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="form-start-date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="form-end-date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="form-end-date" name="end_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="form-type" class="form-label">Type</label>
                        <select class="form-select" id="form-type" name="type" required>
                            <option value="Course">Course</option>
                            <option value="Workshop">Workshop</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="form-mode" class="form-label">Mode</label>
                        <select class="form-select" id="form-mode" name="mode" required>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

