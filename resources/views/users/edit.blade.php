<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-lg font-semibold mb-4">Edit User</h3>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone_no" class="form-label">Phone No</label>
                    <input type="text" class="form-control" name="phone_no" value="{{ $user->phone_no }}">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" name="role" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</x-app-layout>
