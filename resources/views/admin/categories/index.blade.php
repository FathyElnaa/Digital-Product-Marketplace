@extends('admin.layouts.app')

@section('title', 'categories Management')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Management</h5>
                            <a href="{{ route('admin.categories.create') }}" type="button" class="btn btn-outline-primary">Add
                                New Category</a>
                            <table class="table table-bordered">
                                <!-- Table with stripped rows -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>slug</th>
                                            <th>description</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Create At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($categories as $category)
                                             <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td>{{ $category->created_at->format('Y/m/d') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}" type="button"
                                                        class="btn btn-outline-warning">Edit</a>
                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
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
{{ $categories->links('pagination::bootstrap-5') }}

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
