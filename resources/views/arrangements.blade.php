<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Artisan Arrangements</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .quantity-input {
            width: 40px;
            height: 30px;
            text-align: center;
            border: 1px solid #dee2e6;
            border-left: none;
            border-right: none;
        }
        .card {
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .card-text {
            flex-grow: 1;
            font-size: 0.9rem;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .hover-shadow {
            transition: box-shadow 0.3s ease;
        }
        .hover-shadow:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .sticky-nav {
            position: sticky;
            top: 56px;
            z-index: 40;
        }
        .price {
            font-weight: bold;
            color: #28a745;
            margin: 10px 0;
        }
        .btn-add-to-cart {
            margin-top: auto;
        }
        .arrangement-image {
        height: 250px; 
        width: 100%;
        object-fit: cover;
        border-radius: 0.25rem 0.25rem 0 0; /* Optional: matches card rounding */
    }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-seedling me-2"></i> FIORA
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    
                    <!-- Flower Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('flowers') ? 'active' : '' }}" 
                           href="#" 
                           id="flowersDropdown"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Floral Collection
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="flowersDropdown">
                            <li><a class="dropdown-item" href="flowers#rose"><i class="fas fa-heart text-success me-2"></i> Rose Collection</a></li>
                            <li><a class="dropdown-item" href="flowers#lotus"><i class="fas fa-spa text-success me-2"></i> Lotus Collection</a></li>
                            <li><a class="dropdown-item" href="flowers#otherfl"><i class="fas fa-leaf text-success me-2"></i> Other Blooms</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('arrangements') ? 'active' : '' }}" href="{{ url('arrangements') }}">Arrangements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('about') }}">Our Story</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    @endauth
                </ul>
                
                <!-- Auth Links -->
                <div class="d-flex align-items-center">
                    <a href="{{ url('checkout') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-shopping-cart me-1"></i> Cart
                    </a>
                    
                    @auth
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" 
                                id="userDropdown"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
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
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-user me-1"></i> Log In
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light">
                        <i class="fas fa-star me-1"></i> Register
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

   @role('admin')
<div class="text-end me-3">
    <a href="{{ route('arrangements.editMode') }}" 
       class="btn btn-warning shadow-sm px-4 py-2 rounded-pill fw-bold">
        <i class="fas fa-edit me-2"></i> Edit Mode
    </a>
</div>
@endrole

    <main class="py-4">
        <!-- Hero Section -->
        <section class="py-5 bg-success bg-opacity-10 border-bottom border-success">
            <div class="container text-center">
                <h1 class="display-5 fw-bold">
                    Artisan Arrangements
                </h1>
                <p class="lead mx-auto" style="max-width: 600px;">
                    Masterfully crafted floral designs to elevate every occasion and express your deepest emotions.
                </p>
            </div>
        </section>

        <!-- Arrangements Grid -->
        <section class="py-5 bg-white">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($arrangements as $arrangement)
                    <div class="col">
                        <div class="card h-100 hover-shadow">
                        <img src="{{ asset($arrangement->image) }}" alt="{{ $arrangement->name }}" class="arrangement-image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $arrangement->name }}</h5>
                                <p class="card-text">{{ $arrangement->description }}</p>
                                <p class="price">Rs.{{ number_format($arrangement->price, 2) }}</p>
                                
                                <!-- Add to Cart Form -->
                                <form method="POST" action="{{ route('cart.add') }}" class="mt-auto">
                                    @csrf
                                    <input type="hidden" name="item_type" value="arrangement">
                                    <input type="hidden" name="item_id" value="{{ $arrangement->id }}">
                                    <input type="hidden" name="name" value="{{ $arrangement->name }}">
                                    <input type="hidden" name="price" value="{{ $arrangement->price }}">
                                    <input type="hidden" name="image" value="{{ $arrangement->image }}">

                                    <div class="mb-3">
                                        <label for="qty-{{ $arrangement->id }}" class="form-label">Quantity:</label>
                                        <input type="number" 
                                               id="qty-{{ $arrangement->id }}" 
                                               name="qty" 
                                               value="1" 
                                               min="1" 
                                               class="form-control" 
                                               required>
                                    </div>

                                    <button type="submit" class="btn btn-outline-success w-100 btn-add-to-cart">
                                        <i class="fas fa-plus me-1"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        
                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </main>

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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>