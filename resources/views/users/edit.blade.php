<!-- resources/views/user/edit.blade.php -->
<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Your form fields like name, email, etc. -->

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Update</button>
</form>
