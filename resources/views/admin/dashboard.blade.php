@extends('layouts.app')

@section('content')
    <h2>Admin Dashboard</h2>
    <a href="{{ route('admin.users') }}">Manage Users</a>
@endsection
