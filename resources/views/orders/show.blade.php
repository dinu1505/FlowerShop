<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - Fiora</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ecfdf5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #047857;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-hover:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .footer {
            background-color: #111827;
        }
        .badge-admin {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-supplier {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .badge-customer {
            background-color: #fef3c7;
            color: #92400e;
        }
        .stat-card {
            border: none;
            border-radius: 10px;
        }
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .order-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-seedling me-2"></i> FIORA
            </a>
            <div class="d-flex align-items-center">
                @auth
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                        <span class="badge 
                            @if(Auth::user()->hasRole('admin')) badge-admin
                            @else badge-customer @endif">
                            @if(Auth::user()->hasRole('admin')) Admin
                            @else Customer @endif
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-circle me-2 text-success"></i> Your Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2 text-success"></i> Sign Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Order Content -->
    <div class="container py-5">
        <div class="order-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="fas fa-receipt me-2 text-success"></i> Order #{{ $order->id }}
                    </h2>
                    <p class="text-success mb-0">
                        <i class="fas fa-calendar-alt me-1"></i> {{ $order->created_at->format('l, F j, Y') }}
                    </p>
                </div>
                <div>
                    <span class="badge bg-success bg-opacity-10 text-success">
                        <i class="fas fa-check-circle me-1"></i> Completed
                    </span>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card stat-card card-hover h-100">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Customer Details</h5>
                            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                            <p><strong>Address:</strong> {{ $order->customer_address }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card stat-card card-hover h-100">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Order Summary</h5>
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td>Item:</td>
                                        <td>{{ $order->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Quantity:</td>
                                        <td>{{ $order->qty }}</td>
                                    </tr>
                                    <tr>
                                        <td>Unit Price:</td>
                                        <td>Rs.{{ number_format($order->price, 2) }}</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>Total:</td>
                                        <td>Rs.{{ number_format($order->total, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer pt-5 pb-4 mt-5">
        <div class="container">
            <div class="mt-5 pt-4 border-top border-dark d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="text-center text-md-start mb-3 mb-md-0">
                    <p class="text-muted small mb-1">
                        &copy; 2023 Fiora Botanical Atelier. All petals preserved.
                    </p>
                    <p class="text-muted small">
                        Crafted with <i class="fas fa-heart text-danger"></i> by Dinura Banuka
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>