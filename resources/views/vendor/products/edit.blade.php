@extends('vendor.layouts.app')

@section('title', 'Update Product')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Update Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vendor.products.index') }}">Product Management</a></li>
                    <li class="breadcrumb-item active">Update Category</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update Product</h5>

                            <form class="row g-3" method="POST" action="{{ route('vendor.products.update',$product->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="name" name="title"
                                        value="{{ $product->title }}">
                                    @error('title')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ old('slug') }}">
                                </div> --}}

                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                                        value="{{ $product->price }}">
                                    @error('price')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                                    @error('description')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="file_path" class="form-label">Product File</label>
                                    <input type="file" class="form-control" id="file_path" name="file_path" value="{{ $product->file_path }}">
                                    @error('file_path')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" value="{{ $product->thumbnail }}">
                                    @error('thumbnail')
                                        <small class="text-danger mt-2">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-warning" type="submit">Update Product</button>
                                    <a href="{{ route('vendor.products.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>


                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
