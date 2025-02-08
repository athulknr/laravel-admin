<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-success text-white text-center">
                            <h3 class="mb-0">Edit User</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Name</label>
                                    <input type="text" name="name" id="name" class="form-control rounded-pill" value="{{ $user->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" id="email" class="form-control rounded-pill" value="{{ $user->email }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_no" class="form-label fw-bold">Phone No</label>
                                    <input type="text" name="phone_no" id="phone_no" class="form-control rounded-pill" value="{{ $user->phone_no ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label for="role" class="form-label fw-bold">Role</label>
                                    <select name="role" id="role" class="form-select rounded-pill">
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success btn-lg rounded-pill">Update</button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg rounded-pill">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .card {
        border-radius: 15px;
    }
    .form-control, .form-select {
        border-radius: 20px;
        padding: 10px;
    }
    .btn-success {
        background-color: #2173cb;
        border: none;
        transition: 0.3s;
    }
    .btn-success:hover {
        background-color: #2173cb;
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        transition: 0.3s;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
