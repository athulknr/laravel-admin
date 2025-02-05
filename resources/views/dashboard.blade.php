<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Bar -->
            <div class="flex justify-center mb-4">
                <form action="{{ route('dashboard') }}" method="GET" class="flex">
                    <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}"
                        class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                        class="btn btn-primary">Search</button>
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
                                <th class="border px-4 py-2">Actions</th> <!-- Added Actions column -->
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
                                        <!-- Edit Button -->
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary text-white bg-blue-500 px-4 py-2 rounded-md">Edit</a>

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
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
            <!-- End User List Table -->

        </div>
    </div>
</x-app-layout>
