@extends('admin.layouts.app')

@section('title', 'Update User')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Update User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User Management</a></li>
                    <li class="breadcrumb-item active">Update User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-15">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update User</h5>
                            <!-- Browser Default Validation -->
                            <form class="row g-3" method="POST" action = '{{ route('admin.users.update',$user) }}'>
                                @csrf
                                @method('PUT')
                                <div class="col-md-5">
                                    <label for="validationDefault01" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="validationDefault01"
                                        value="{{ $user->name }}" name='name'>
                                </div>
                                <div class="col-md-5">
                                    <label for="validationDefault02" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="validationDefault02"
                                        value="{{ $user->email }}" name='email'>
                                </div>

                                <div class="col-md-5">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">

                                </div>

                                <div class="col-md-5">
                                    <label for="validationDefault04" class="form-label">Role</label>
                                    <select class="form-select" aria-label="Default select example" name='role'>
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="vendor">Vendor</option>
                                        <option value="customer">Customer</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-warning" type="submit">Update User</button>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger"
                                        type="submit">Cancel</a>
                                </div>
                            </form>
                            <!-- End Browser Default Validation -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main><!-- End #main -->
@endsection
