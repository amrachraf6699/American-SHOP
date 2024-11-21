@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
    <div class="container my-5">
        <h2 class="text-center fw-bold mb-5">Order History</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-warning text-center">
                You have not placed any orders yet.
            </div>
        @else
            <div class="row g-4">
                @foreach ($orders as $order)
                    <div class="col-md-6 col-lg-4">
                        <div class="cardBlogStyle1 card-recent-post shadow-lg rounded h-100 d-flex flex-column">
                            <!-- Card Info -->
                            <div class="cardInfo p-4 flex-grow-1">
                                <!-- Status -->
                                <span class="trends {{ $order->status }}">
                                    {{ str_replace('_', ' ', ucfirst($order->status)) }}
                                </span>

                                <!-- Order Title -->
                                <a href="{{ route('orders.show', $order) }}">
                                    <h2 class="post-meta-title">
                                        Order #{{ $order->id }}
                                    </h2>
                                </a>

                                <!-- Order Date -->
                                <span class="post-blog-date">
                                    Placed on {{ $order->created_at->format('M d, Y') }}
                                </span>

                                <!-- Total -->
                                <p class="mt-3">
                                    <strong>Total:</strong> ${{ number_format($order->total, 2) }}
                                </p>
                            </div>

                            <!-- Links Section -->
                            <div class="mt-auto p-4 d-flex justify-content-between">
                                <!-- View Details -->
                                <a class="read-more position-relative d-flex align-items-center gap-2" href="{{ route('orders.show', $order) }}">
                                    View Details
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                        <path d="M4.66797 11.8265L11.3346 5.15979M11.3346 5.15979H5.33464M11.3346 5.15979V11.1598"
                                            stroke="#161C2D"
                                            stroke-width="1.4"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>

                                @if($order->status == 'delivered')
                                <!-- Give Feedback -->
                                <a class="read-more position-relative d-flex align-items-center gap-2" href="{{ route('orders.feedback', $order) }}">
                                    Give Feedback
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                        <path d="M4.66797 11.8265L11.3346 5.15979M11.3346 5.15979H5.33464M11.3346 5.15979V11.1598"
                                            stroke="#161C2D"
                                            stroke-width="1.4"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif
    </div>

    <style>
        /* General Card Styles */
        .cardBlogStyle1 {
            background-color: #fff;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .cardBlogStyle1:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .cardImage img {
            border-bottom: 1px solid #eaeaea;
            max-height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .cardInfo {
            position: relative;
        }

        .trends {
            display: inline-block;
            padding: 5px 10px;
            font-size: 0.9rem;
            font-weight: bold;
            border-radius: 15px;
            margin-bottom: 10px;
        }

        .trends.awaiting_payment {
            background-color: #ffc107;
            color: #fff;
        }

        .trends.paid {
            background-color: #007bff;
            color: #fff;
        }

        .trends.shipped {
            background-color: #17a2b8;
            color: #fff;
        }

        .trends.delivered {
            background-color: #28a745;
            color: #fff;
        }

        .trends.canceled {
            background-color: #dc3545;
            color: #fff;
        }

        .post-meta-title {
            font-size: 1.25rem;
            color: #161C2D;
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .post-meta-title:hover {
            text-decoration: underline;
        }

        .post-blog-date {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .read-more {
            font-size: 0.875rem;
            font-weight: bold;
            color: #161C2D;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .read-more:hover {
            color: #007bff;
        }

        .read-more svg {
            margin-left: 5px;
        }
    </style>
@endsection
