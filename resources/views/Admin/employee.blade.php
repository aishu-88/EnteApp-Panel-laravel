{{-- resources/views/admin/staff/employees.blade.php --}}
@extends('layouts.admin')



@section('content')
{{-- Page Title --}}
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0">Employees List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="">Staff Management</a></li>
                    <li class="breadcrumb-item active">Employees</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- Flash Messages --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Employees List Table --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Manage Admin Team Members</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-soft-primary btn-sm material-shadow-none" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <i class="ri-add-line align-middle"></i> Add New Employee
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->user_type === 'service_provider')
                                    Employee
                                    @else
                                    {{ ucfirst(str_replace('_', ' ', $user->user_type)) }}
                                    @endif
                                </td>

                                <td>{{ $user->phone ?? '-' }}</td>

                                <td>
                                    <!-- VIEW -->
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                        class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No users found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Employee Modal --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="employeeName" name="name" placeholder="Enter full name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="employeeEmail" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="employeeEmail" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="employeeRole" class="form-label">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="employeeRole" name="role" required>
                            <option value="">Select Role</option>
                            <option value="super-admin" {{ old('role') == 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="moderator" {{ old('role') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                            <option value="support" {{ old('role') == 'support' ? 'selected' : '' }}>Support Staff</option>
                            <option value="analyst" {{ old('role') == 'analyst' ? 'selected' : '' }}>Analyst</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="employeeDepartment" class="form-label">Department</label>
                        <input type="text" class="form-control @error('department') is-invalid @enderror" id="employeeDepartment" name="department" placeholder="Enter department" value="{{ old('department') }}" required>
                        @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addEmployeeForm" class="btn btn-primary">Add Employee</button>
            </div>
        </div>
    </div>
</div>
@endsection