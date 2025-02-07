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
            <!-- Add User Button -->
            <a href="{{ route('user.create') }}" id="btn-add-user" class="btn btn-success">Add User</a>

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
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
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

    </script>
</x-app-layout>
