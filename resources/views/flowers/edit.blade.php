<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Manage Flowers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Match arrangements page styling */
        body {
            background-color: #f8f9fa;
        }
        h1, h3 {
            font-weight: bold;
            color: #155724;
        }
        .card-header {
            background-color: #198754 !important;
            color: white;
            font-weight: 600;
        }
        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }
        .btn-success:hover {
            background-color: #146c43;
            border-color: #146c43;
        }
        .table-success th {
            background-color: #198754 !important;
            color: white;
        }
        footer {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Navbar (from arrangements page) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-seedling me-2"></i> FIORA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('flowers') ? 'active' : '' }}" href="{{ url('flowers') }}">Floral Collection</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('arrangements') ? 'active' : '' }}" href="{{ url('arrangements') }}">Arrangements</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('about') }}">Our Story</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @endauth
                </ul>
                <div class="d-flex align-items-center">
                    <a href="{{ url('checkout') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-shopping-cart me-1"></i> Cart
                    </a>
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-circle text-success me-2"></i> Your Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt text-success me-2"></i> Sign Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2"><i class="fas fa-user me-1"></i> Log In</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light"><i class="fas fa-star me-1"></i> Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h1>Manage Flowers</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Add New Flower --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header">Add New Flower</div>
            <div class="card-body">
                <form action="{{ route('flowers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" placeholder="Flower Name" class="form-control mb-2" required>
                    <select name="category" class="form-control mb-2" required>
                        <option value="rose">Rose</option>
                        <option value="lotus">Lotus</option>
                        <option value="other">Other</option>
                    </select>
                    <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
                    <input type="number" step="0.01" name="price" placeholder="Price" class="form-control mb-2" required>
                    <input type="file" name="image" class="form-control mb-2">
                    <button class="btn btn-success">Add Flower</button>
                </form>
            </div>
        </div>

        {{-- Existing Flowers --}}
        @foreach(['rose' => $roses, 'lotus' => $lotus, 'other' => $others] as $category => $flowers)
            <h3 class="mt-4">{{ ucfirst($category) }}</h3>
            <table class="table table-bordered table-striped">
                <tr class="table-success">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                @foreach($flowers as $flower)
                    <tr>
                        <form action="{{ route('flowers.update', $flower->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <td><input type="text" name="name" value="{{ $flower->name }}" class="form-control"></td>
                            <td><textarea name="description" class="form-control">{{ $flower->description }}</textarea></td>
                            <td><input type="number" step="0.01" name="price" value="{{ $flower->price }}" class="form-control"></td>
                            <td>
                                @if($flower->image)
                                    <img src="{{ asset('storage/images/' . $flower->image) }}" width="50">
                                @endif
                                <input type="file" name="image" class="form-control mt-1">
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm">Update</button>
                        </form>
                        <form action="{{ route('flowers.destroy', $flower->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                            </td>
                    </tr>
                @endforeach
            </table>
        @endforeach
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>