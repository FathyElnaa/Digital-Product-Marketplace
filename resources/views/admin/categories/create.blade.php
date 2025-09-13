@extends('admin.layouts.app')

@section('title', 'Create New Category')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create New Category</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Category Management</a></li>
                    <li class="breadcrumb-item active">Create New Category</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Category</h5>

                            <form class="row g-3" method="POST" action="{{ route('admin.categories.store') }}">
                                @csrf

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-6">
                                    <label for="title" class="form-label">Title (Optional)</label>
                                    <input type="text" class="form-control" id="title"
                                           name="title" value="{{ old('title') }}">
                                </div> --}}

                                <div class="col-md-12">
                                    <label for="description" class="form-label">Description (Optional)</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Create Category</button>
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
