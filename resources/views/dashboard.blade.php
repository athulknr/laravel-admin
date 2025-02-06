<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="flex justify-center mb-4">
                <form action="{{ route('dashboard') }}" method="GET" class="flex">
                    <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}"
                        class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('dashboard') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700">Reset</a>
                </form>
            </div>

            <!-- User List Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">User List</h3>
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Phone No</th>
                                <th class="border px-4 py-2">Role</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="text-center">
                                    <td class="border px-4 py-2">{{ $user->id }}</td>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">{{ $user->phone_no ?? 'N/A' }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Edit Button (Triggers Modal) -->
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

                                        <!-- Delete Button -->
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-white bg-red-500 px-4 py-2 rounded-md" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center border px-4 py-2">No users found.</td>
                                </tr>
                            @endforelse
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

                        <div class="mb-3">
                            <label for="editUserRole" class="form-label">Role</label>
                            <select class="form-control" id="editUserRole" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
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

    <!-- JavaScript to Populate Modal Fields -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function () {
                    let userId = this.getAttribute('data-id');
                    let userName = this.getAttribute('data-name');
                    let userEmail = this.getAttribute('data-email');
                    let userPhone = this.getAttribute('data-phone');
                    let userRole = this.getAttribute('data-role');

                    document.getElementById('editUserId').value = userId;
                    document.getElementById('editUserName').value = userName;
                    document.getElementById('editUserEmail').value = userEmail;
                    document.getElementById('editUserPhone').value = userPhone;
                    document.getElementById('editUserRole').value = userRole;

                    document.getElementById('editUserForm').setAttribute('action', '/user/' + userId);
                });
            });
        });
    </script>
</x-app-layout>
