<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Add User Button -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>

            <!-- Search Bar -->
            <div class="flex justify-center mb-4">
                <div class="flex justify-center mb-4">
                    <input type="text" id="search" placeholder="Search users..." class="form-control">
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_no ?? 'N/A' }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <button class="btn btn-success edit-btn"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-phone="{{ $user->phone_no }}"
                                            data-role="{{ $user->role }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal">
                                        Edit
                                    </button>

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

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUserForm" method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="addUserName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="addUserName" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="addUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addUserEmail" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="addUserPhone" class="form-label">Phone No</label>
                            <input type="text" class="form-control" id="addUserPhone" name="phone_no" minlength="10" maxlength="11" required>
                            <small class="text-danger d-none" id="phoneError">Phone number must be at least 10 digits.</small>
                        </div>

                        <div class="mb-3">
                            <label for="addUserRole" class="form-label">Role</label>
                            <select class="form-control" id="addUserRole" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editUserId">
                        <div class="mb-3">
                            <label for="editUserName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editUserName" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="editUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editUserEmail" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="editUserPhone" class="form-label">Phone No</label>
                            <input type="text" class="form-control" id="editUserPhone" name="phone_no">
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


    <!-- Add New User MOdal -->

    <script>
        document.getElementById('addUserForm').addEventListener('submit', function(event) {
            let phoneInput = document.getElementById('addUserPhone');
            let phoneError = document.getElementById('phoneError');

            if (phoneInput.value.length < 10) {
                event.preventDefault(); // Prevent form submission
                phoneError.classList.remove('d-none'); // Show error message
            } else {
                phoneError.classList.add('d-none'); // Hide error message if valid
            }
        });
    </script>

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
                                rows += `
                                    <tr>
                                        <td>${user.id}</td>
                                        <td>${user.name}</td>
                                        <td>${user.email}</td>
                                        <td>${user.phone_no ?? 'N/A'}</td>
                                        <td>${user.role.charAt(0).toUpperCase() + user.role.slice(1)}</td>
                                        <td>
                                            <button class="btn btn-success edit-btn"
                                                    data-id="${user.id}"
                                                    data-name="${user.name}"
                                                    data-email="${user.email}"
                                                    data-phone="${user.phone_no}"
                                                    data-role="${user.role}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal">
                                                Edit
                                            </button>
                                            <form action="/user/${user.id}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger text-white" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>`;
                            });
                        } else {
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
        // When Edit button is clicked
        $(document).on('click', '.edit-btn', function() {
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            const userEmail = $(this).data('email');
            const userPhone = $(this).data('phone');

            // Populate the modal form with the current user data
            $('#editUserId').val(userId);
            $('#editUserName').val(userName);
            $('#editUserEmail').val(userEmail);
            $('#editUserPhone').val(userPhone);
        });

        // Submit the form for user update
        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();
            const userId = $('#editUserId').val();

            $.ajax({
                url: `/user/${userId}`,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    $('#editUserModal').modal('hide');
                    alert('User updated successfully!');
                    location.reload();
                },
                error: function(response) {
                    alert('Error updating user');
                }
            });
        });
    </script>
</x-app-layout>
