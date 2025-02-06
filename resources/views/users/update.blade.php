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

    <button type="submit" class="btn btn-success">Update</button>
</form>
