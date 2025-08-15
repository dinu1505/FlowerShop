<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Blossom Heaven</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-bg {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.8)), 
                        url('{{asset("images/bouquet.jpg")}}');
            background-size: cover;
            background-position: center;
        }
        .category-card {
            transition: all 0.3s ease;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .arrangement-card {
            transition: all 0.3s ease;
        }
        .arrangement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .feature-icon {
            width: 4rem;
            height: 4rem;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    
                    <!-- Flower Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('flowers') ? 'active' : '' }}" 
                           href="#" role="button" data-bs-toggle="dropdown">
                            Floral Collection
                        </a>
                        <ul class="dropdown-menu">
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
                
                <div class="d-flex align-items-center">
                    <a href="{{ url('checkout') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-shopping-cart me-1"></i> Cart
                    </a>

                    @auth
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
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

    <!-- Hero Section -->
    <header class="hero-bg py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3">
                        Nature's Poetry in<br>
                        <span class="text-success">Every Flower</span>
                    </h1>
                    <p class="lead mb-4">
                        Where floral dreams take root and blossom into breathtaking realities. Handcrafted arrangements delivered with care to your sanctuary.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{url('/flowers')}}" class="btn btn-success btn-lg px-4">
                            Discover Blooms
                        </a>
                        <a href="#featured" class="btn btn-outline-success btn-lg px-4">
                            Seasonal Specials
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="{{asset('images/bouquet.jpg')}}" alt="Masterpiece bouquet from Fiora" class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Featured Categories -->
    <section id="featured" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Our Botanical Treasures</h2>
                <p class="lead text-muted">Curated collections for every sentiment and celebration</p>
            </div>

            <div class="row g-4">
                <!-- Rose Category -->
                <div class="col-md-4">
                    <div class="card h-100 category-card border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="{{asset('images/ct_rose.jpg')}}" class="card-img-top" alt="Timeless roses collection">
                            <span class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 rounded m-2 small fw-bold">BESTSELLER</span>
                        </div>
                        <div class="card-body">
                            <h3 class="h5 card-title">The Timeless Rose Collection</h3>
                            <p class="card-text text-muted">Elegance perfected in every petal</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="{{ url('flowers#rose') }}" class="btn btn-success w-100">
                                Explore Roses <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Colorful Flowers -->
                <div class="col-md-4">
                    <div class="card h-100 category-card border-0 shadow-sm">
                        <img src="{{asset('images/ct_tulip.jpg')}}" class="card-img-top" alt="Vibrant blooms collection">
                        <div class="card-body">
                            <h3 class="h5 card-title">Vibrant Blooms Collection</h3>
                            <p class="card-text text-muted">Nature's most joyful color palette</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="{{ url('flowers#otherfl') }}" class="btn btn-success w-100">
                                Explore Flowers <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Lotus -->
                <div class="col-md-4">
                    <div class="card h-100 category-card border-0 shadow-sm">
                        <img src="{{asset('images/ct_lotus.jpg')}}" class="card-img-top" alt="Serene lotus collection">
                        <div class="card-body">
                            <h3 class="h5 card-title">Serene Lotus Collection</h3>
                            <p class="card-text text-muted">Purity and enlightenment embodied</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <a href="{{ url('flowers#lotus') }}" class="btn btn-success w-100">
                                Explore Lotus <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Arrangements -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
                <h2 class="display-5 fw-bold mb-3 mb-md-0">Signature Arrangements</h2>
                <a href="{{ url('arrangements') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-spa me-2"></i> View All Masterpieces
                </a>
            </div>

            <div class="row g-4">
                <!-- Rose Bouquet -->
                <div class="col-md-4">
                    <div class="card h-100 arrangement-card border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="{{asset('images/red_rosebq.jpg')}}" class="card-img-top" alt="Enchanted rose bouquet">
                            <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 rounded m-2 small fw-bold">BESTSELLER</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="h5 card-title mb-0">Enchanted Rose Bouquet</h3>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <p class="card-text text-muted">A symphony of romance in every stem</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold">From $45</span>
                            <a href="{{url('arrangements#roseBouq')}}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-eye me-1"></i> Preview
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Flower Basket -->
                <div class="col-md-4">
                    <div class="card h-100 arrangement-card border-0 shadow-sm">
                        <img src="{{asset('images/flower-basket.jpg')}}" class="card-img-top" alt="Rustic charm flower basket">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="h5 card-title mb-0">Rustic Charm Basket</h3>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="card-text text-muted">Countryside elegance in woven splendor</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold">From $38</span>
                            <a href="{{ url('arrangements#basket') }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-eye me-1"></i> Preview
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Heart Shape -->
                <div class="col-md-4">
                    <div class="card h-100 arrangement-card border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="{{asset('images/heart.jpg')}}" class="card-img-top" alt="Whispering heart floral arrangement">
                            <span class="position-absolute top-0 start-0 bg-pink-500 text-white px-2 py-1 rounded m-2 small fw-bold">ROMANTIC</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h3 class="h5 card-title mb-0">Whispering Heart</h3>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="card-text text-muted">Love's language in floral form</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                            <span class="text-success fw-bold">From $52</span>
                            <a href="{{ url('arrangements#heart') }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-eye me-1"></i> Preview
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">The Fiora Difference</h2>
                <p class="lead text-muted">Why discerning flower lovers choose our botanical artistry</p>
            </div>

            <div class="row g-4">
                <!-- Same-Day Delivery -->
                <div class="col-md-4 text-center">
                    <div class="feature-icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4">
                        <i class="fas fa-bolt fa-2x"></i>
                    </div>
                    <h3 class="h4">Lightning Delivery</h3>
                    <p class="text-muted">
                        Order by noon for same-day floral magic delivered to their door. Our petal couriers never miss a beat.
                    </p>
                </div>

                <!-- Fresh Flowers -->
                <div class="col-md-4 text-center">
                    <div class="feature-icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4">
                        <i class="fas fa-leaf fa-2x"></i>
                    </div>
                    <h3 class="h4">Farm-Fresh Petals</h3>
                    <p class="text-muted">
                        Harvested at peak perfection, our blooms arrive fresher than morning dew with unparalleled longevity.
                    </p>
                </div>

                <!-- Satisfaction Guaranteed -->
                <div class="col-md-4 text-center">
                    <div class="feature-icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4">
                        <i class="fas fa-heart fa-2x"></i>
                    </div>
                    <h3 class="h4">Bliss Guarantee</h3>
                    <p class="text-muted">
                        Your delight is our promise - we'll move heaven and earth to ensure every arrangement sparks joy.
                    </p>
                </div>
            </div>
        </div>
    </section>

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