@extends('vendor.layouts.app')
@section('title', 'Reviews Management')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reviews</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reviews Management</h5>
                            <table class="table table-bordered">
                                <!-- Table with stripped rows -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Customer Name</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                            <th data-type="date" data-format="YYYY/DD/MM">Create At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @forelse ($reviews as $review)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $review->product->title }}</td>
                                                <td>{{ $review->user->name }}</td>
                                                <td>
                                                    @for ($i = 1; $i <= $review->rating; $i++)
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                    @endfor
                                                </td>
                                                <td>{{ $review->comment }}</td>
                                                <td>{{ $review->created_at->format('Y/m/d') }}</td>
                                                <td>
                                                    @if ($review->reply)
                                                        <span class="badge bg-info">Replied</span>
                                                    @else
                                                        <!-- زرار فتح المودال -->
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#replyModal{{ $review->id }}">
                                                            Reply
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- ✅ مودال الرد -->
                                            <div class="modal fade" id="replyModal{{ $review->id }}" tabindex="-1"
                                                aria-labelledby="replyModalLabel{{ $review->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="replyModalLabel{{ $review->id }}">
                                                                Reply to {{ $review->user->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <form action="{{ route('vendor.reviews.reply',$review->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p><strong>Product:</strong> {{ $review->product->title }}
                                                                </p>
                                                                <p><strong>Review:</strong> {{ $review->comment }}</p>
                                                                <input type="text" name="reply" class="form-control"
                                                                    placeholder="Write your reply...">
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Send
                                                                    Reply</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No Reviews Found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                                <!-- End Table with stripped rows -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
