<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Edit User</h3>

                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Name:</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Email:</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Phone No:</label>
                        <input type="text" name="phone_no" value="{{ $user->phone_no }}" class="w-full px-4 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Role:</label>
                        <select name="role" class="w-full px-4 py-2 border rounded-lg">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
