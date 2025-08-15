<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-seedling me-2"></i> FIORA
            </a>

            <!-- Mobile Menu Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Desktop Navigation -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('flowers') ? 'active' : '' }}" href="{{ url('flowers') }}">Floral Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('arrangements') ? 'active' : '' }}" href="{{ url('arrangements') }}">Arrangements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('about') }}">Our Story</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                </ul>

                <!-- Auth Links -->
                <div class="d-flex align-items-center">
                    <a href="{{ url('checkout') }}" class="btn btn-sm btn-success me-2">
                        <i class="fas fa-shopping-cart me-1"></i> Cart
                    </a>

                    @auth
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                            @if(Auth::user()->hasRole('admin'))
                            <span class="badge badge-admin ms-2">Admin</span>
                            @else
                            <span class="badge badge-customer ms-2">Customer</span>
                            @endif
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
                    @else
                    <!-- Guest Links -->
                    <a href="{{ route('login') }}" class="btn btn-sm btn-light me-2">
                        <i class="fas fa-user me-1"></i> Log In
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-star me-1"></i> Register
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="py-5">
        <div class="container">
            <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
                <!-- Common Welcome Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">
                            Welcome Back, {{ Auth::user()->name }}!
                        </h2>
                        <p class="text-success mb-0">
                            <i class="fas fa-calendar-alt me-1"></i> {{ now()->format('l, F j, Y') }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="text-muted small me-3">Last login: {{ now()->subHours(2)->format('M j, Y g:i a') }}</span>
                        <span class="badge 
                            @if(Auth::user()->hasRole('admin')) badge-admin
                            @else badge-customer @endif">
                            @if(Auth::user()->hasRole('admin')) Admin
                            @else Customer @endif
                        </span>
                    </div>
                </div>

                @if(Auth::user()->hasRole('admin'))
                <!-- Admin Dashboard -->
                <div class="admin-dashboard">
                    <div class="row g-4 mb-4">
                        <!-- Total Sales -->
                        <div class="col-md-6">
                            <div class="card stat-card card-hover h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted small mb-1">Total Sales</p>
                                            <h3 class="text-success mb-0">Rs. {{ number_format($totalSales, 2) }}</h3>
                                        </div>
                                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                    </div>
                                    <p class="text-muted small mt-2 mb-0"><span class="text-success">↑ 18%</span> from last month</p>
                                </div>
                            </div>
                        </div>

                        <!-- Inventory Items -->
                        <div class="col-md-6">
                            <div class="card stat-card card-hover h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted small mb-1">Inventory Items</p>
                                            <h3 class="text-purple mb-0">{{ $totalItems }}</h3>
                                        </div>
                                        <div class="stat-icon bg-purple bg-opacity-10 text-purple">
                                            <i class="fas fa-boxes"></i>
                                        </div>
                                    </div>
                                    <p class="text-muted small mt-2 mb-0">
                                        <span class="text-danger">{{ $lowStockCount }} low</span> in stock
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="addItemForm" method="POST" action="{{ route('inventory.store') }}" class="mb-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <input type="text" name="product" class="form-control" placeholder="Product Name" required>
        </div>
        <div class="col-md-3">
            <input type="number" name="stock" class="form-control" placeholder="Stock" required>
        </div>
        <div class="col-md-3">
            <input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Add</button>
        </div>
    </div>
</form>
                    <!-- Inventory Table -->
                    <table id="inventoryTable" class="table table-striped">
    <thead>
        <tr>
            <th>Product</th>
            <th>Stock</th>
            <th>Price (Rs)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventory as $item)
        <tr data-id="{{ $item->id }}">
            <td class="product">{{ $item->product }}</td>
            <td class="stock">{{ $item->stock }}</td>
            <td class="price">{{ $item->price }}</td>
            <td>
                <button class="btn btn-sm btn-primary editBtn">Edit</button>
                <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                @else
                <!-- Customer Dashboard -->
                <div class="customer-dashboard">
                    <div class="row g-4 mb-4">
                        <!-- Orders Card -->
                        <div class="col-md-6">
                            <div class="card stat-card card-hover h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted small mb-1">Orders</p>
                                            <h3 class="text-warning mb-0">{{ $ordersCount }}</h3>
                                        </div>
                                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-box-open"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Table -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-12">
                            <h3 class="fw-bold mb-3">Your Orders</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Item</th>
                                        <th>Total (Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                {{ $order->name }}<br>
                                                <span class="text-muted small">Qty: {{ $order->qty }}</span>
                                            </td>
                                            <td>Rs.{{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}" class="text-success">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Trending Products -->
                    <div class="row g-4">
                        <div class="col-md-12">
                            <h3 class="fw-bold mb-3">Trending Products</h3>
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    @forelse($trendingProducts as $product)
                                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                            <div class="bg-purple bg-opacity-10 rounded-2 p-3 me-3">
                                                <i class="fas fa-spa text-purple"></i>
                                            </div>
                                            <div>
                                                <h4 class="fw-medium mb-0">{{ $product->name }}</h4>
                                                <p class="text-muted small mb-0">Rs.{{ number_format($product->price,2) }}</p>
                                                <p class="text-muted small mb-0">
                                                    <span class="text-success">{{ $product->total_sold }}</span> sold
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">No trending products yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <!-- About Fiora -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-bold mb-3">
                        <i class="fas fa-seedling me-2"></i> FIORA
                    </h3>
                    <p class="text-secondary small">
                        Cultivating floral artistry since 2014, Fiora transforms nature's bounty into breathtaking botanical experiences that touch the soul.
                    </p>
                    <div class="mt-3">
                        <a href="#" class="text-secondary me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-secondary me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-secondary me-3"><i class="fab fa-pinterest"></i></a>
                        <a href="#" class="text-secondary"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-bold mb-3">Explore Fiora</h3>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ url('/') }}" class="text-secondary">Home Garden</a></li>
                        <li class="mb-2"><a href="{{ url('flowers') }}" class="text-secondary">Floral Catalog</a></li>
                        <li class="mb-2"><a href="{{ url('arrangements') }}" class="text-secondary">Arrangements</a></li>
                        <li><a href="{{ url('about') }}" class="text-secondary">Our Story</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-bold mb-3">Support</h3>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ url('login') }}" class="text-secondary">Your Account</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary">Floral Consultations</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary">Delivery Information</a></li>
                        <li><a href="#" class="text-secondary">Share Your Thought</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-bold mb-3">Visit Our Shop</h3>
                    <address class="small text-secondary not-italic">
                        <div class="d-flex mb-2">
                            <i class="fas fa-map-marker-alt mt-1 me-2"></i>
                            <span>56/5, Kandy Road<br>Nuwara-eliya, Sri Lanka</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <span>+94 76 456 132</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <span>FioraShop@gmail.com</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock me-2"></i>
                            <span>Mon-Sat: 9am-4pm</span>
                        </div>
                    </address>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top border-secondary d-md-flex justify-content-between align-items-center">
                <div class="text-center text-md-start mb-3 mb-md-0">
                    <p class="small text-secondary">
                        &copy; 2023 Fiora Botanical Atelier. All petals preserved.
                    </p>
                    <p class="small text-secondary">
                        Crafted with <i class="fas fa-heart text-danger"></i> by Dinura Banuka
                    </p>
                </div>
                <div class="d-flex justify-content-center justify-content-md-end align-items-center">
                    <i class="fas fa-map-marker-alt text-secondary me-2"></i>
                    <span class="small text-secondary">Find Our Floral Studio</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModeToggle = document.getElementById('edit-mode-toggle');
            
            function toggleEditMode(isEditMode) {
                console.log('Edit mode is now:', isEditMode);
                if(isEditMode) {
                    console.log('Edit mode enabled - showing editable elements');
                } else {
                    console.log('Edit mode disabled - hiding editable elements');
                }
            }
            
            if(editModeToggle) {
                editModeToggle.addEventListener('change', function() {
                    toggleEditMode(this.checked);
                });
            }
            
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });

        $(function(){
    // Add Item
    $('#addItemForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });

    // Edit Item
    $(document).on('click', '.editBtn', function(){
        let row = $(this).closest('tr');
        row.find('td.product').html('<input type="text" class="form-control" value="' + row.find('td.product').text().trim() + '">');
        row.find('td.stock').html('<input type="number" class="form-control" value="' + row.find('td.stock').text().trim() + '">');
        row.find('td.price').html('<input type="number" step="0.01" class="form-control" value="' + row.find('td.price').text().trim() + '">');
        $(this).text('Save').removeClass('editBtn').addClass('saveBtn');
    });

    // Save Changes
    $(document).on('click', '.saveBtn', function(){
        let row = $(this).closest('tr');
        let id = row.data('id');
        let product = row.find('td.product input').val();
        let stock = row.find('td.stock input').val();
        let price = row.find('td.price input').val();

        $.ajax({
            url: '/inventory/' + id,
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                product: product,
                stock: stock,
                price: price
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });

    // Delete Item
    $(document).on('click', '.deleteBtn', function(){
        if(confirm('Are you sure you want to delete this item?')){
            let row = $(this).closest('tr');
            let id = row.data('id');

            $.ajax({
                url: '/inventory/' + id,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success) {
                        row.fadeOut(300, function() {
                            row.remove();
                        });
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        }
    });
});
    </script>
</body>
</html>