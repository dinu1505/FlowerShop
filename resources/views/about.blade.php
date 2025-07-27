<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Our Story</title>
    <!-- Alpine.js CDN -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased">
       <!-- Navigation -->
    <nav class="bg-emerald-700 sticky top-0 z-50 shadow-lg" x-data="{ mobileMenuOpen: false, flowerMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center text-white text-xl font-bold">
                        <i class="fas fa-seedling mr-2"></i> FIORA
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <!-- Main Links -->
                    <div class="flex space-x-4">
                        <a href="{{ url('/') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->is('/') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Home</a>
                        
                        <!-- Flower Categories Dropdown -->
                        <div class="relative" x-data="{ flowerMenuOpen: false }">
                            <a href="{{url('flowers')}}">
                            <button @click="flowerMenuOpen = !flowerMenuOpen" 
                                    class="text-white px-3 py-2 rounded-md text-sm font-medium flex items-center {{ request()->is('flowers') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">
                                Floral Collection
                                <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            </a>

                            <!-- Flower Dropdown Menu -->
                            <div x-show="flowerMenuOpen" 
                                 @click.away="flowerMenuOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                <div class="py-1">
                                    <a href="flowers#rose" @click="flowerMenuOpen = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 flex items-center">
                                        <i class="fas fa-heart text-emerald-600 mr-2 w-5"></i> Rose Collection
                                    </a>
                                    <a href="flowers#lotus" @click="flowerMenuOpen = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 flex items-center">
                                        <i class="fas fa-spa text-emerald-600 mr-2 w-5"></i> Lotus Collection
                                    </a>
                                    <a href="flowers#otherfl" @click="flowerMenuOpen = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 flex items-center">
                                        <i class="fas fa-leaf text-emerald-600 mr-2 w-5"></i> Other Blooms
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ url('arrangements') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->is('arrangements') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Arrangements</a>
                        <a href="{{ url('about') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->is('about') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Our Story</a>
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->is('dashboard') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Dashboard</a>
                        @endauth
                    </div>

                    <!-- Auth Links -->
                    <div class="flex items-center space-x-4 ml-4">
                        <a href="{{ url('checkout') }}" class="relative inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-800 hover:bg-emerald-600">
                            <i class="fas fa-shopping-cart mr-1"></i> Cart
                        </a>

                        @auth
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false}">
                            <button @click="open = !open" type="button" class="flex items-center text-sm rounded-full focus:outline-none">
                                <span class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-emerald-800 bg-white">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-2 -mr-1 h-5 w-5 text-emerald-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>

                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50">
                                    <i class="fas fa-user-circle mr-2 text-emerald-600"></i> Your Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50">
                                        <i class="fas fa-sign-out-alt mr-2 text-emerald-600"></i> Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <!-- Guest Links -->
                        <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-emerald-800 bg-white hover:bg-gray-100">
                            <i class="fas fa-user mr-1"></i> Log In
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-emerald-800 bg-white hover:bg-gray-100">
                            <i class="fas fa-star mr-1"></i> Register
                        </a>
                        @endauth
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-emerald-600 focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden" x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-transition>
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ url('/') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Home</a>
                <a href="{{ url('flowers') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->is('flowers') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Floral Collection</a>
                <a href="{{ url('arrangements') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->is('arrangements') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Artisan Arrangements</a>
                <a href="{{ url('about') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->is('about') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Our Story</a>
                @auth
                <a href="{{ url('/dashboard') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->is('dashboard') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Dashboard</a>
                @endauth
                
                <div class="pt-4 border-t border-emerald-800">
                    <a href="{{ url('checkout') }}" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-600">
                        <i class="fas fa-shopping-cart mr-2"></i> Cart
                    </a>
                    
                    @auth
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-600">
                        <i class="fas fa-user-circle mr-2"></i> Your Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-600">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-600">
                        <i class="fas fa-user mr-2"></i> Log In
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-600">
                        <i class="fas fa-star mr-2"></i> Register
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        <!-- About Hero Section -->
        <section class="py-12 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                    <div class="mb-8 lg:mb-0">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Our Story</span>
                        </h1>
                        <p class="mt-3 text-xl text-gray-500">
                            Bringing beauty and joy through flowers since 2014
                        </p>
                    </div>
                    <div class="relative rounded-lg shadow-lg overflow-hidden">
                        <img src="{{asset('images/flowershop.jpg')}}" alt="Fiora Flower Shop" class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Our Mission -->
        <section class="py-12 bg-emerald-50 mb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                    <div class="order-2 lg:order-1 mt-8 lg:mt-0">
                        <img src="{{asset('images/mission.jpg')}}" alt="Our Mission" class="w-full rounded-lg shadow-lg">
                    </div>
                    <div class="order-1 lg:order-2">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-6">Our Mission</h2>
                        <div class="space-y-4 text-gray-600">
                            <p>At <span class="font-bold text-emerald-700">Fiora</span>, we believe flowers have the power to brighten days, celebrate life's special moments, and express emotions when words aren't enough.</p>
                            <p>Our mission is to provide the freshest, most beautiful flowers while delivering exceptional customer service and making every interaction with our shop a delightful experience.</p>
                            <p>We source our flowers from local growers whenever possible to ensure quality and support our community.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Values -->
        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-12">Our Values</h2>
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-3">
                    <!-- Quality -->
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                            <i class="fas fa-leaf text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Quality</h3>
                        <p class="text-gray-600">We use only the freshest flowers and materials in all our arrangements.</p>
                    </div>
                    
                    <!-- Customer Care -->
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                            <i class="fas fa-heart text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Customer Care</h3>
                        <p class="text-gray-600">Your satisfaction is our top priority. We stand behind every arrangement.</p>
                    </div>
                    
                    <!-- Sustainability -->
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                            <i class="fas fa-globe-americas text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Sustainability</h3>
                        <p class="text-gray-600">We're committed to eco-friendly practices in our shop and deliveries.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Testimonials -->
        <section class="py-12 bg-emerald-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-12">What Our Customers Say</h2>
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <!-- Testimonial 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-amber-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <blockquote class="text-gray-600 mb-4">
                            "The flowers were absolutely stunning and arrived right on time for my anniversary. My wife loved them!"
                        </blockquote>
                        <div class="flex items-center">
                            <div>
                                <h4 class="font-medium text-gray-900">Pathum Nissanka</h4>
                                <p class="text-sm text-gray-500">Verified Customer</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-amber-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <blockquote class="text-gray-600 mb-4">
                            "I order flowers monthly for my office and they're always fresh and beautiful. Excellent service!"
                        </blockquote>
                        <div class="flex items-center">
                            <div>
                                <h4 class="font-medium text-gray-900">Srikathi Jayasinghe</h4>
                                <p class="text-sm text-gray-500">Business Customer</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Testimonial 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-amber-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <blockquote class="text-gray-600 mb-4">
                            "The tropical arrangement was perfect for my mother's birthday. She couldn't stop talking about it!"
                        </blockquote>
                        <div class="flex items-center">
                            <div>
                                <h4 class="font-medium text-gray-900">Chamari Athapaththu</h4>
                                <p class="text-sm text-gray-500">Verified Customer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Visit Us -->
        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                    <div class="mb-8 lg:mb-0">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-6">Visit Our Shop</h2>
                        <div class="space-y-4 text-gray-600">
                            <p class="flex items-start">
                                <i class="fas fa-map-marker-alt text-emerald-600 mt-1 mr-3"></i>
                                <span>NO 56/5, Kandy Road, Nuwara-eliya</span>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-phone text-emerald-600 mr-3"></i>
                                <span>+94 76 456 132</span>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-envelope text-emerald-600 mr-3"></i>
                                <span>FioraShop@gmail.com</span>
                            </p>
                            <p class="flex items-center">
                                <i class="fas fa-clock text-emerald-600 mr-3"></i>
                                <span>Open Monday-Saturday: 9am-4pm</span>
                            </p>
                            <a href="https://www.google.com/maps/place/Nuwara+Eliya/@6.9513644,80.7397471,13z/data=!3m1!4b1!4m6!3m5!1s0x3ae380434e1554c7:0x291608404c937d9c!8m2!3d6.9606886!4d80.7692959!16zL20vMDJoZzcw?entry=ttu&g_ep=EgoyMDI1MDYxNi4wIKXMDSoASAFQAw%3D%3D" 
                               target="_blank" 
                               rel="noopener" 
                               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 mt-4">
                                Get Directions
                            </a>
                        </div>
                    </div>
                    <div class="rounded-lg shadow-lg overflow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.018736036825!2d80.77363131512425!3d6.957089494994491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2563c8c933f8d%3A0x9b9a9e4038c0957e!2sNuwara%20Eliya!5e0!3m2!1sen!2slk!4v1687171000000!5m2!1sen!2slk" 
                                width="100%" 
                                height="400" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>

       <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Fiora -->
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-seedling mr-2"></i> FIORA
                    </h3>
                    <p class="text-gray-400 text-sm">
                        Cultivating floral artistry since 2014, Fiora transforms nature's bounty into breathtaking botanical experiences that touch the soul.
                    </p>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-pinterest"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Explore Fiora</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white text-sm">Home Garden</a></li>
                        <li><a href="{{ url('flowers') }}" class="text-gray-400 hover:text-white text-sm">Floral Catalog</a></li>
                        <li><a href="{{ url('arrangements') }}" class="text-gray-400 hover:text-white text-sm">Arrangements</a></li>
                        <li><a href="{{ url('about') }}" class="text-gray-400 hover:text-white text-sm">Our Story</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ url('login') }}" class="text-gray-400 hover:text-white text-sm">Your Account</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Floral Consultations</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Delivery Information</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white text-sm">Share Your Thought</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Visit Our Shop</h3>
                    <address class="text-gray-400 text-sm not-italic">
                        <div class="flex items-start mb-2">
                            <i class="fas fa-map-marker-alt mt-1 mr-2"></i>
                            <span>56/5, Kandy Road<br>Nuwara-eliya, Sri Lanka</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-phone mr-2"></i>
                            <span>+94 76 456 132</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>FioraShop@gmail.com</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            <span>Mon-Sat: 9am-4pm</span>
                        </div>
                    </address>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-gray-400 text-sm">
                        &copy; 2023 Fiora Botanical Atelier. All petals preserved.
                    </p>
                    <p class="text-gray-500 text-xs mt-1">
                        Crafted with <i class="fas fa-heart text-red-400"></i> by Dinura Banuka
                    </p>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                    <span class="text-gray-400 text-sm">Find Our Floral Studio</span>
                </div>
            </div>
        </div>
    </footer>
   
</body>
</html>