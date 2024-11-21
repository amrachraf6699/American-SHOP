@extends('manage.layout')
@section('title', 'Newsletter Subscribers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <!-- Card for Subscribers -->
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-primary mb-0">Newsletter Subscribers</h5>
                    <a href="{{ route('admin.home') }}" class="btn btn-outline-secondary btn-sm">Back to Dashboard</a>
                </div>
                <div class="card-body">
                    <!-- Subscribers List -->
                    @if($subscribers->isEmpty())
                        <p class="text-muted text-center">No subscribers found.</p>
                    @else
                        <div class="table-responsive shadow-sm rounded">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Email</th>
                                        <th>Subscribed On</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribers as $subscriber)
                                        <tr>
                                            <td class="align-middle">{{ $subscriber->email }}</td>
                                            <td class="align-middle">{{ $subscriber->created_at->format('d M, Y') }} ({{ $subscriber->created_at->diffForHumans() }})</td>
                                            <td class="align-middle">
                                                <form action="{{ route('admin.newsletter.destroy', $subscriber->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-danger">
                                                        <i class="bx bx-trash"></i> Unsubscribe
                                                    </button>
                                                </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $subscribers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
