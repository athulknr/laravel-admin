@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add a New Blog</h2>
    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Short Description</label>
            <textarea name="short_description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>
            <input type="text" name="tags" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit Blog</button>
    </form>
</div>
@endsection
