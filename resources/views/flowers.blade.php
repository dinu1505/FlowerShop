<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Floral Collection</title>
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
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
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
        .flower-image {
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
                            <li><a class="dropdown-item" href="#rose"><i class="fas fa-heart text-success me-2"></i> Rose Collection</a></li>
                            <li><a class="dropdown-item" href="#lotus"><i class="fas fa-spa text-success me-2"></i> Lotus Collection</a></li>
                            <li><a class="dropdown-item" href="#otherfl"><i class="fas fa-leaf text-success me-2"></i> Other Blooms</a></li>
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
<div class="text-end mb-3">
    <a href="{{ route('flowers.editMode') }}" class="btn btn-warning shadow-sm px-4 py-2 rounded-pill fw-bold">
        <i class="fas fa-edit me-2"></i> Edit Mode
    </a>
</div>
@endrole
    <main class="py-4">
        <!-- Hero Section -->
        <section class="py-5 bg-success bg-opacity-10 border-bottom border-success">
            <div class="container text-center">
                <h1 class="display-5 fw-bold">
                    Our Floral Collection
                </h1>
                <p class="lead mx-auto" style="max-width: 600px;">
                    Discover nature's poetry in every petal - handpicked blooms to express your deepest emotions and brighten every occasion.
                </p>
            </div>
        </section>

        <!-- Flower Categories Navigation (Mobile) -->
        <section class="d-lg-none py-3 bg-white sticky-top" style="top: 56px;">
            <div class="container">
                <div class="d-flex overflow-auto pb-2">
                    <a href="#rose" class="btn btn-sm btn-success me-2 rounded-pill">
                        <i class="fas fa-heart me-1"></i> Roses
                    </a>
                    <a href="#lotus" class="btn btn-sm btn-outline-success me-2 rounded-pill">
                        <i class="fas fa-spa me-1"></i> Lotus
                    </a>
                    <a href="#otherfl" class="btn btn-sm btn-outline-success rounded-pill">
                        <i class="fas fa-leaf me-1"></i> Other Blooms
                    </a>
                </div>
            </div>
        </section>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@php
$cart = session('cart', []);
@endphp

@if(count($cart) > 0)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"> Your Cart</h5>
            <ul class="list-group">
                @foreach($cart as $id => $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $item['name'] }} (x{{ $item['qty'] }})
                        </div>
                        <div class="d-flex align-items-center">
                            <strong class="me-3">Rs.{{ number_format($item['price'] * $item['qty'], 2) }}</strong>
                            <form method="POST" action="{{ route('cart.remove') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif



     <!-- Flowers Grid -->
<section class="py-5 bg-white">
    <div class="container">
        <!-- Roses Section -->
        <div id="rose" class="mb-5">
            <h2 class="h2 fw-bold mb-4 pb-2 border-bottom border-success">
                <i class="fas fa-heart text-success me-2"></i> Rose Collection
            </h2>
            <div class="row g-4">
 @foreach ($roses as $flower)
                <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
 <img src="{{ asset($flower->image) }}" alt="{{ $flower->name }}" class="flower-image">

            <div class="card-body">
                <h3 class="h5 card-title">{{ $flower->name }}</h3>
                <p class="card-text text-muted small">{{ $flower->description }}</p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="fw-bold text-success">Rs.{{ number_format($flower->price, 2) }}</span>
                    <div class="d-flex align-items-center">
                        <form method="POST" action="{{ route('cart.add') }}" class="me-2">
                            @csrf
                            <input type="hidden" name="item_type" value="flower">
                            <input type="hidden" name="item_id" value="{{ $flower->id }}">
                            <input type="hidden" name="name" value="{{ $flower->name }}">
                            <input type="hidden" name="price" value="{{ $flower->price }}">
                            <input type="hidden" name="image" value="{{ $flower->image }}">
                            
                            <div class="input-group input-group-sm">
                                <label for="qty" class="input-group-text">Qty:</label>
                                <input type="number" name="qty" value="1" min="1" class="form-control" style="width: 60px;" required>
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
      </div>
        </div> <!-- Close rose section -->
    
            <div id="lotus" class="mb-5">
            <h2 class="h2 fw-bold mb-4 pb-2 border-bottom border-success">
                <i class="fas fa-spa text-success me-2"></i> Lotus Collection
            </h2>
            <div class="row g-4">
                @foreach ($lotus as $flower)
                <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
<img src="{{ asset($flower->image) }}" alt="{{ $flower->name }}" class="flower-image">

            <div class="card-body">
                <h3 class="h5 card-title">{{ $flower->name }}</h3>
                <p class="card-text text-muted small">{{ $flower->description }}</p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="fw-bold text-success">Rs.{{ number_format($flower->price, 2) }}</span>
                    <div class="d-flex align-items-center">
                        <form method="POST" action="{{ route('cart.add') }}" class="me-2">
                            @csrf
                            <input type="hidden" name="item_type" value="flower">
                            <input type="hidden" name="item_id" value="{{ $flower->id }}">
                            <input type="hidden" name="name" value="{{ $flower->name }}">
                            <input type="hidden" name="price" value="{{ $flower->price }}">
                            <input type="hidden" name="image" value="{{ $flower->image }}">
                            
                            <div class="input-group input-group-sm">
                                <label for="qty" class="input-group-text">Qty:</label>
                                <input type="number" name="qty" value="1" min="1" class="form-control" style="width: 60px;" required>
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
         </div>
                @endforeach
            </div>
        </div>

              <!-- Other Flowers Section -->
        <div id="otherfl" class="mb-5">
            <h2 class="h2 fw-bold mb-4 pb-2 border-bottom border-success">
                <i class="fas fa-leaf text-success me-2"></i> Other Blooms
            </h2>
            <div class="row g-4">
                @foreach ($other as $flower)
                <div class="col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm hover-shadow">
<img src="{{ asset($flower->image) }}" alt="{{ $flower->name }}" class="flower-image">

            <div class="card-body">
                <h3 class="h5 card-title">{{ $flower->name }}</h3>
                <p class="card-text text-muted small">{{ $flower->description }}</p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="fw-bold text-success">Rs.{{ number_format($flower->price, 2) }}</span>
                    <div class="d-flex align-items-center">
                        <form method="POST" action="{{ route('cart.add') }}" class="me-2">
                            @csrf
                            <input type="hidden" name="item_type" value="flower">
                            <input type="hidden" name="item_id" value="{{ $flower->id }}">
                            <input type="hidden" name="name" value="{{ $flower->name }}">
                            <input type="hidden" name="price" value="{{ $flower->price }}">
                            <input type="hidden" name="image" value="{{ $flower->image }}">
                            
                            <div class="input-group input-group-sm">
                                <label for="qty" class="input-group-text">Qty:</label>
                                <input type="number" name="qty" value="1" min="1" class="form-control" style="width: 60px;" required>
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                 </div>
                @endforeach
            </div>
        </div> <!-- Close other flowers section -->
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
    
    <!-- Quantity Control Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quantity increment/decrement functionality
            document.querySelectorAll('.quantity-control').forEach(control => {
                const decrementBtn = control.querySelector('.decrement');
                const incrementBtn = control.querySelector('.increment');
                const quantityInput = control.querySelector('.quantity-input');
                
                decrementBtn.addEventListener('click', () => {
                    let value = parseInt(quantityInput.value);
                    if (value > 1) {
                        quantityInput.value = value - 1;
                    }
                });
                
                incrementBtn.addEventListener('click', () => {
                    let value = parseInt(quantityInput.value);
                    quantityInput.value = value + 1;
                });
                
                // Ensure the value doesn't go below 1 when manually changed
                quantityInput.addEventListener('change', () => {
                    if (quantityInput.value < 1 || isNaN(quantityInput.value)) {
                        quantityInput.value = 1;
                    }
                });
            });
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
            
            // Add to cart functionality
            document.querySelectorAll('.btn-success').forEach(btn => {
                btn.addEventListener('click', function() {
                    const card = this.closest('.card');
                    const title = card.querySelector('.card-title').textContent;
                    const price = card.querySelector('.fw-bold.text-success').textContent;
                    const quantity = card.querySelector('.quantity-input').value;
                    
                    // Here you would typically send this data to your cart system
                    alert(`Added to cart: ${quantity} x ${title} (${price} each)`);
                });
            });
        });
    </script>
</body>
</html>