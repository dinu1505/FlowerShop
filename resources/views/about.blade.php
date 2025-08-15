<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Our Story</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
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
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-seedling me-2"></i> FIORA
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    
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
                
                <div class="d-flex align-items-center">
                    <a href="{{ url('checkout') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-shopping-cart me-1"></i> Cart
                    </a>
                    
                    @auth
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

    <main class="py-4">
        <section class="py-5 bg-success bg-opacity-10 border-bottom border-success">
            <div class="container text-center">
                <h1 class="display-5 fw-bold">
                    Our Story
                </h1>
                <p class="lead mx-auto" style="max-width: 600px;">
                    From a humble beginning to a blooming brand, Fiora is a testament to passion and artistry.
                </p>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <img src="{{ asset('images/flowershop.jpg') }}" alt="Fiora Founders" class="img-fluid rounded shadow-sm">
                    </div>
                    <div class="col-lg-6">
                        <h2 class="h3 fw-bold text-success">Our Journey</h2>
                        <p class="text-secondary">
                            Fiora was founded in 2014 by a group of passionate florists who believed in the power of flowers to tell a story. We started with a small shop in Nuwara-eliya, handcrafting arrangements for local events and celebrations. Our commitment to using only the freshest, most beautiful blooms quickly earned us a loyal following.
                        </p>
                        <p class="text-secondary">
                            Over the years, we've grown, but our core mission remains the same: to create unique, high-quality floral designs that bring joy and beauty to people's lives. Every bouquet, every arrangement is a work of art, carefully crafted with love and attention to detail.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-white">
            <div class="container text-center">
                <h2 class="h3 fw-bold text-success mb-5">Our Values</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100 p-4 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="icon-circle text-success mb-3">
                                    <i class="fas fa-leaf fa-3x"></i>
                                </div>
                                <h5 class="card-title fw-bold">Sustainability</h5>
                                <p class="card-text text-secondary small">
                                    We are committed to sourcing our flowers ethically and sustainably, working with local farms and minimizing our environmental footprint.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 p-4 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="icon-circle text-success mb-3">
                                    <i class="fas fa-heart fa-3x"></i>
                                </div>
                                <h5 class="card-title fw-bold">Artistry</h5>
                                <p class="card-text text-secondary small">
                                    Each arrangement is a unique piece of art, designed to reflect the emotions and personality of both the giver and the recipient.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 p-4 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="icon-circle text-success mb-3">
                                    <i class="fas fa-handshake fa-3x"></i>
                                </div>
                                <h5 class="card-title fw-bold">Community</h5>
                                <p class="card-text text-secondary small">
                                    We believe in building relationships, not just with our customers, but with our suppliers and the wider community.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container text-center">
                <h2 class="h3 fw-bold text-success mb-5">Meet Our Team</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100 p-4 border-0 shadow-sm">
                            <div class="card-body d-flex flex-column align-items-center">
                                <img src="https://media.istockphoto.com/id/660150716/photo/young-businessman-with-beard-smiling-towards-camera.jpg?s=612x612&w=0&k=20&c=bmOLrjsgfJziLXsfquG87i_tvjD4GsPj41HAvzRcflQ=" alt="Team Member 1" class="profile-img mb-3">
                                <h5 class="card-title fw-bold">Amal Perera</h5>
                                <p class="text-success small">Founder & Lead Florist</p>
                                <p class="card-text text-secondary small">
                                    With over a decade of experience, Amara's vision and passion for flowers are the heart of Fiora.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 p-4 border-0 shadow-sm">
                            <div class="card-body d-flex flex-column align-items-center">
                                <img src="https://tse2.mm.bing.net/th/id/OIP.rOUlgM4RQ3CCyom5K7q1bAAAAA?r=0&w=262&h=393&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Team Member 2" class="profile-img mb-3">
                                <h5 class="card-title fw-bold">Kasun Silva</h5>
                                <p class="text-success small">Head of Operations</p>
                                <p class="card-text text-secondary small">
                                    Kasun ensures every arrangement is delivered on time and in perfect condition, maintaining our high standards.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 p-4 border-0 shadow-sm">
                            <div class="card-body d-flex flex-column align-items-center">
                                <img src=https://tse3.mm.bing.net/th/id/OIP.TNoxvfbWIddcw9ONiTab0wHaE8?r=0&rs=1&pid=ImgDetMain&o=7&rm=3 alt="Team Member 3" class="profile-img mb-3">
                                <h5 class="card-title fw-bold">Nayana Fernando</h5>
                                <p class="text-success small">Creative Designer</p>
                                <p class="card-text text-secondary small">
                                    Nayana's innovative designs and artistic flair bring a fresh perspective to our floral collections.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
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

                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-bold mb-3">Explore Fiora</h3>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ url('/') }}" class="text-secondary">Home Garden</a></li>
                        <li class="mb-2"><a href="{{ url('flowers') }}" class="text-secondary">Floral Catalog</a></li>
                        <li class="mb-2"><a href="{{ url('arrangements') }}" class="text-secondary">Arrangements</a></li>
                        <li><a href="{{ url('about') }}" class="text-secondary">Our Story</a></li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-3">
                    <h3 class="h5 fw-bold mb-3">Support</h3>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ url('login') }}" class="text-secondary">Your Account</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary">Floral Consultations</a></li>
                        <li class="mb-2"><a href="#" class="text-secondary">Delivery Information</a></li>
                        <li><a href="#" class="text-secondary">Share Your Thought</a></li>
                    </ul>
                </div>

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