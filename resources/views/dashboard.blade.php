<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                Manage Users
            </button>

            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>


            <a href="{{ route('user.create') }}" id="btn-add-user" class="btn btn-success">Add User</a>
            <a href="{{ route('users.index') }}" id="btn-view-users" class="btn btn-primary">View Authors</a>


            <div class="flex justify-center mb-4">
                <div class="flex justify-center mb-4">
                    <input type="text" id="search" placeholder="Search users.." class="form-control">
                </div>

            </div>
            <!-- User List Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">User List</h3>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_no ?? 'N/A' }}</td>
                                <td id="role-{{ $user->id }}">{{ $user->role }}</td>
                                <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                <td><!-- Delete Button -->
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-white" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item {{ $users->previousPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $users->previousPageUrl() ?? '#' }}">Previous</a>
                            </li>
                            <li class="page-item {{ $users->nextPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $users->nextPageUrl() ?? '#' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End User List Table -->
        </div>
    </div>


<!-- User Management Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- User List Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr id="userRow{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="editUser({{ $user->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Add User Modal-->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Create User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery & AJAX for handling form submission -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addUserForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(response) {
                    alert("Error: " + response.responseJSON.message);
                }
            });
        });
    });
</script>




<script>

    // Edit User
    function editUser(userId) {
        let newName = prompt("Enter new name:");
        let newEmail = prompt("Enter new email:");

        if (newName && newEmail) {
            fetch(/users/${userId}/update, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ name: newName, email: newEmail })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("User updated successfully!");
                    location.reload();
                } else {
                    alert("Error updating user.");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    }

    // Delete User
    function deleteUser(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            fetch(`/users/${userId}/delete`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("User deleted successfully!");
                    document.getElementById(`userRow${userId}`).remove();
                } else {
                    alert("Error deleting user.");
                }
            })
            .catch(error => console.error("Error:", error));
        }
    }
</script>









<!-- Script Section-->

    <!-- Javascript live search -->
    <script>
       $(document).ready(function() {
    $('#search').on('keyup', function() {
        let query = $(this).val();

        $.ajax({
            url: "{{ route('users.search') }}",
            type: "GET",
            data: { query: query },
            success: function(data) {
                let rows = '';
                if (data.length > 0) {
                    $.each(data, function(index, user) {
                        if (user.role.toLowerCase() !== 'admin') { // Exclude admins
                            rows += `
                                <tr>
                                    <td>${user.id}</td>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.phone_no ?? 'N/A'}</td>
                                    <td>${user.role.charAt(0).toUpperCase() + user.role.slice(1)}</td>
                                    <td>
                                        <form action="/users/${user.id}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>`;
                            }
                    });
                }

                if (rows === '') {
                    rows = `<tr><td colspan="6" class="text-center">No users found</td></tr>`;
                }

                $('#userTableBody').html(rows);
            }
        });
    });
});

    </script>


    <!-- JavaScript to Populate Modal Fields -->
    <script>
       $(document).ready(function() {
    // AJAX DELETE request
    $(document).on('click', '.delete-user', function() {
        let userId = $(this).data('id'); // Get user ID from button attribute
        let url = "{{ url('users') }}/" + userId; // Construct URL for DELETE request

        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: url,
                type: "POST", // Use POST instead of DELETE
                data: {
                    _method: "DELETE", // Laravel requires this to simulate DELETE
                    _token: "{{ csrf_token() }}" // CSRF token for security
                },
                success: function(response) {
                    if (response.success) {
                        // Remove the deleted user row from the table smoothly
                        $("#user-row-" + userId).fadeOut(500, function() {
                            $(this).remove();
                        });
                    } else {
                        alert("Error deleting user!");
                    }
                },
                error: function(xhr) {
                    alert("Something went wrong!");
                }
            });
        }
    });
});
    </script>

    <!-- jQuery & AJAX for handling form submission -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addUserForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(response) {
                    alert("Error: " + response.responseJSON.message);
                }
            });
        });
    });
</script>
</x-app-layout>
