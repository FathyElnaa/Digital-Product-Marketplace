@extends('admin.layouts.app')

@section('title', 'Users Management')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>جدول المستخدمين</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Management</h5>
                            <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-outline-primary">Add
                                New User</a>
                            <table class="table table-bordered">
                                <!-- Table with stripped rows -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Create At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->created_at->format('Y/m/d') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" type="button"
                                                        class="btn btn-outline-warning">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"class="btn btn-outline-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <!-- End Table with stripped rows -->
                                {{ $users->links('pagination::bootstrap-5') }}

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
