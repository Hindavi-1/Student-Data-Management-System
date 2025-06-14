<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Employee List</h2>
    <!-- Add Employee Button -->
    <a href="#" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addEmployeeModal">Add</a>

    <!-- Employee Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Date of Joining</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->date_of_joining }}</td>
                <td>{{ $employee->gender }}</td>
                <td>
                    <img src="{{ asset('storage/uploads/'.$employee->photo)}}" width="100px" height="70" alt="photo">
                </td>
                <td><span class="badge badge-success">{{ $employee->status }}</span></td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-success btn-sm" onclick="editEmployee({{ $employee->id }})">
                        Edit
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Date of Joining</label>
                        <input type="date" name="date_of_joining" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                    <div>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="edit_email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" id="edit_address" name="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Date of Joining</label>
                        <input type="date" id="edit_date_of_joining" name="date_of_joining" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select id="edit_gender" name="gender" class="form-control">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
