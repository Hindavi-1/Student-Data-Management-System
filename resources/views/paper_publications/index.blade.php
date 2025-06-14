<div class="container mt-4">
    <!-- Title -->
   

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="section-title text-primary">
            📰 Student Paper Publications</h2>
            <p class="section-subtitle text-muted">View, edit, and manage your paper publications below.</p>
        </div>
        <button class="btn btn-primary btn-lg add-btn" data-bs-toggle="modal" data-bs-target="#addPublicationModal">
            <i class="fas fa-plus-circle"></i> Add New Publication
        </button>
    </div>



    <!-- Search  -->
    <div class="input-group mb-4">
        <input type="text" id="searchCourses" class="form-control" placeholder="Search Papers..." onkeyup="filterCourses()">
        <span class="input-group-text">
            <i class="fas fa-search"></i>
        </span>
    </div>
    

    <!-- Publications Table -->
    <div class="table-container mt-4">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Authors</th>
                    <th>Journal Name</th>
                    <th>Publication Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="publicationsTableBody">
                @forelse ($publications as $publication)
                    <tr>
                        <td>{{ $publication->title }}</td>
                        <td>{{ $publication->authors }}</td>
                        <td>{{ $publication->journal_name }}</td>
                        <td>{{ $publication->publication_date ? \Carbon\Carbon::parse($publication->publication_date)->format('d-m-Y') : 'N/A' }}</td>
                        <td>

                                <button class="btn btn-warning btn-sm edit-publiation-btn" data-id="{{ $publication->id }}" data-bs-toggle="modal" data-bs-target="#editPublicationModal">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-primary edit-publication-btn" data-publication='@json($publication)' data-bs-toggle="modal" data-bs-target="#editPublicationModal">
                                <i class="fas fa-edit"></i> Edit
                            </a> -->
                            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-primary edit-publication-btn" data-publication='@json($publication)'>
                                    <i class="fas fa-edit"></i> Edit
                            </a> -->

                            <form method="POST" action="{{ route('paper-publications.destroy', $publication->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this publication?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            @if ($publication->document_path)
                                <a href="{{ Storage::url($publication->document_path) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No Publications Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Publication Modal -->
<div class="modal fade" id="addPublicationModal" tabindex="-1" aria-labelledby="addPublicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPublicationModalLabel">Add New Publication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('paper-publications.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="authors" class="form-label">Authors</label>
                        <input type="text" class="form-control" id="authors" name="authors" required>
                    </div>
                    <div class="mb-3">
                        <label for="journal_name" class="form-label">Journal Name</label>
                        <input type="text" class="form-control" id="journal_name" name="journal_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="publication_date" class="form-label">Publication Date</label>
                        <input type="date" class="form-control" id="publication_date" name="publication_date">
                    </div>
                    <div class="mb-3">
                        <label for="document" class="form-label">Upload Document</label>
                        <input type="file" class="form-control" id="document" name="document" accept=".pdf,.doc,.docx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Publication</button>
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Edit Publication Modal -->
<div class="modal fade" id="editPublicationModal" tabindex="-1" aria-labelledby="editPublicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPublicationModalLabel">Edit Publication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPublicationForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAuthors" class="form-label">Authors</label>
                        <input type="text" class="form-control" id="editAuthors" name="authors" required>
                    </div>
                    <div class="mb-3">
                        <label for="editJournalName" class="form-label">Journal Name</label>
                        <input type="text" class="form-control" id="editJournalName" name="journal_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPublicationDate" class="form-label">Publication Date</label>
                        <input type="date" class="form-control" id="editPublicationDate" name="publication_date">
                    </div>
                    <div class="mb-3">
                        <label for="editDocument" class="form-label">Upload New Document</label>
                        <input type="file" class="form-control" id="editDocument" name="document" accept=".pdf,.doc,.docx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

