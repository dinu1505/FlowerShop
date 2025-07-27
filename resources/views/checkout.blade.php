<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Fiora</title>
    <!-- Alpine.js CDN -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .payment-method {
            @apply border border-gray-200 rounded-lg p-4 mb-4 cursor-pointer transition-all;
        }
        .payment-method:hover {
            @apply border-emerald-500 bg-emerald-50;
        }
        .payment-method.active {
            @apply border-emerald-600 bg-emerald-100;
        }
        .card-input {
            @apply relative;
        }
        .card-icons {
            @apply absolute right-3 top-1/2 transform -translate-y-1/2;
        }
        .card-icons img {
            @apply h-6 ml-2;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Delivery Information -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Delivery Information</h3>
                        </div>
                        <div class="px-6 py-5">
                            <form id="deliveryForm">
                                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                                    <div>
                                        <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                        <input type="text" id="firstName" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                    </div>
                                    <div>
                                        <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                        <input type="text" id="lastName" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input type="email" id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="tel" id="phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Delivery Address</label>
                                        <textarea id="address" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required></textarea>
                                    </div>
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                        <input type="text" id="city" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                    </div>
                                    <div>
                                        <label for="postalCode" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                        <input type="text" id="postalCode" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="deliveryDate" class="block text-sm font-medium text-gray-700 mb-1">Delivery Date</label>
                                        <input type="date" id="deliveryDate" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500" required>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="deliveryNotes" class="block text-sm font-medium text-gray-700 mb-1">Special Instructions</label>
                                        <textarea id="deliveryNotes" rows="2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Payment Method</h3>
                        </div>
                        <div class="px-6 py-5">
                            <div class="space-y-4">
                                <!-- Credit Card -->
                                <div class="payment-method active" data-method="card">
                                    <div class="flex items-center">
                                        <input class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded" type="radio" name="paymentMethod" id="creditCard" checked>
                                        <label for="creditCard" class="ml-3 block text-sm font-medium text-gray-700">
                                            Credit/Debit Card
                                        </label>
                                    </div>
                                    <div class="mt-4 space-y-4">
                                        <div class="card-input">
                                            <label for="cardNumber" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                                            <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 pl-3 pr-16">
                                            <div class="card-icons">
                                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg" alt="Visa">
                                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mastercard/mastercard-original.svg" alt="Mastercard">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-6">
                                            <div class="sm:col-span-2">
                                                <label for="cardName" class="block text-sm font-medium text-gray-700 mb-1">Name on Card</label>
                                                <input type="text" id="cardName" placeholder="John Doe" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            </div>
                                            <div>
                                                <label for="expiryDate" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                                <input type="text" id="expiryDate" placeholder="MM/YY" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            </div>
                                            <div>
                                                <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                                <input type="text" id="cvv" placeholder="123" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PayPal -->
                                <div class="payment-method" data-method="paypal">
                                    <div class="flex items-center">
                                        <input class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded" type="radio" name="paymentMethod" id="paypal">
                                        <label for="paypal" class="ml-3 block text-sm font-medium text-gray-700">
                                            PayPal
                                        </label>
                                    </div>
                                    <div class="mt-4 hidden">
                                        <p class="text-sm text-gray-500">You will be redirected to PayPal to complete your payment securely.</p>
                                    </div>
                                </div>

                                <!-- Cash on Delivery -->
                                <div class="payment-method" data-method="cod">
                                    <div class="flex items-center">
                                        <input class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded" type="radio" name="paymentMethod" id="cod">
                                        <label for="cod" class="ml-3 block text-sm font-medium text-gray-700">
                                            Cash on Delivery
                                        </label>
                                    </div>
                                    <div class="mt-4 hidden">
                                        <p class="text-sm text-gray-500">Pay with cash when your order is delivered.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="mt-6 lg:mt-0 space-y-6">
                    <!-- Order Summary -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                        </div>
                        <div class="px-6 py-5">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Subtotal (3 items)</span>
                                    <span class="text-sm font-medium">Rs.2,499.98</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Delivery Fee</span>
                                    <span class="text-sm font-medium">Rs.300.00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Tax</span>
                                    <span class="text-sm font-medium">Rs.200.00</span>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mt-3">
                                    <div class="flex justify-between">
                                        <span class="text-base font-medium">Total</span>
                                        <span class="text-base font-bold">Rs.2,999.98</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Your Items -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Your Items</h3>
                        </div>
                        <div class="px-6 py-5">
                            <div class="space-y-4">
                                <!-- Item 1 -->
                                <div class="flex">
                                    <img src="{{asset('images/red rose.jpg')}}" class="w-16 h-16 rounded-md object-cover" alt="Red Roses">
                                    <div class="ml-4 flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">Red Roses</h4>
                                        <p class="text-xs text-gray-500">1 dozen</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium">Rs.1000.00</p>
                                        <p class="text-xs text-gray-500">Qty: 1</p>
                                    </div>
                                </div>
                                
                                <!-- Item 2 -->
                                <div class="flex">
                                    <img src="{{asset('images/whiteRose.jpg')}}" class="w-16 h-16 rounded-md object-cover" alt="White Roses">
                                    <div class="ml-4 flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">White Roses</h4>
                                        <p class="text-xs text-gray-500">1 dozen</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium">Rs.799.99</p>
                                        <p class="text-xs text-gray-500">Qty: 1</p>
                                    </div>
                                </div>
                                
                                <!-- Item 3 -->
                                <div class="flex">
                                    <img src="{{asset('images/yellowrose.jpg')}}" class="w-16 h-16 rounded-md object-cover" alt="Yellow Roses">
                                    <div class="ml-4 flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">Yellow Roses</h4>
                                        <p class="text-xs text-gray-500">8 stems</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium">Rs.799.99</p>
                                        <p class="text-xs text-gray-500">Qty: 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Place Order Button -->
                    <button type="button" id="placeOrderBtn" class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <i class="fas fa-lock mr-2"></i> Place Order
                    </button>

                    <p class="text-center text-xs text-gray-500">
                        <i class="fas fa-lock mr-1"></i> Your payment is secure and encrypted.
                    </p>
                </div>
            </div>
        </div>
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

    <!-- Scripts -->
  <script>
document.addEventListener('DOMContentLoaded', function() {
    // Payment method selection (your existing code)
    const paymentMethods = document.querySelectorAll('.payment-method');
    
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            // Remove active class from all methods
            paymentMethods.forEach(m => {
                m.classList.remove('active');
                const input = m.querySelector('input[type="radio"]');
                input.checked = false;
                
                // Hide all details sections
                const details = m.querySelector('div:not(.flex)');
                if(details) details.classList.add('hidden');
            });
            
            // Add active class to clicked method
            this.classList.add('active');
            const input = this.querySelector('input[type="radio"]');
            input.checked = true;
            
            // Show details section for active method
            const details = this.querySelector('div:not(.flex)');
            if(details) details.classList.remove('hidden');
        });
    });
    
    // Card number formatting (your existing code)
    const cardNumber = document.getElementById('cardNumber');
    if(cardNumber) {
        cardNumber.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '');
            if(value.length > 0) {
                value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
            }
            e.target.value = value;
        });
    }
    
    // Expiry date formatting (your existing code)
    const expiryDate = document.getElementById('expiryDate');
    if(expiryDate) {
        expiryDate.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if(value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    }

    // Enhanced delivery form validation
    const deliveryForm = document.getElementById('deliveryForm');
    const inputs = deliveryForm.querySelectorAll('input, textarea');
    const placeOrderBtn = document.getElementById('placeOrderBtn');

    // Add real-time validation
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateField(this);
        });
        
        input.addEventListener('blur', function() {
            validateField(this);
        });
    });

    // Field-specific validation
    function validateField(field) {
        const value = field.value.trim();
        const errorElement = field.nextElementSibling;
        
        // Remove any existing error messages
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.remove();
        }
        
        // Skip validation if field is not required and empty
        if (!field.required && value === '') {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300');
            return true;
        }

        let isValid = true;
        let errorMessage = '';

        switch(field.id) {
            case 'firstName':
            case 'lastName':
            case 'city':
                isValid = /^[a-zA-Z\s\-']{2,}$/.test(value);
                errorMessage = 'Please enter a valid name (letters only, min 2 characters)';
                break;
                
            case 'email':
                isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
                errorMessage = 'Please enter a valid email address';
                break;
                
            case 'phone':
                isValid = /^[\d\s\+\-]{10,15}$/.test(value.replace(/\D/g, '')) && 
                          value.replace(/\D/g, '').length >= 10;
                errorMessage = 'Please enter a valid phone number (10-15 digits)';
                break;
                
            case 'address':
                isValid = value.length >= 10;
                errorMessage = 'Address must be at least 10 characters';
                break;
                
            case 'postalCode':
                isValid = /^[0-9]{5}(?:-[0-9]{4})?$/.test(value);
                errorMessage = 'Please enter a valid postal code';
                break;
                
            case 'deliveryDate':
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const selectedDate = new Date(value);
                isValid = value && selectedDate >= today;
                errorMessage = 'Please select a valid future date';
                break;
                
            default:
                isValid = value !== '';
                errorMessage = 'This field is required';
        }

        // Update field styling
        if (!isValid && field.required) {
            field.classList.remove('border-gray-300');
            field.classList.add('border-red-500');
            
            // Add error message if not already present
            if (!errorElement || !errorElement.classList.contains('error-message')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message mt-1 text-sm text-red-600';
                errorDiv.textContent = errorMessage;
                field.parentNode.insertBefore(errorDiv, field.nextSibling);
            }
        } else {
            field.classList.remove('border-red-500');
            field.classList.add('border-gray-300');
            if (errorElement && errorElement.classList.contains('error-message')) {
                errorElement.remove();
            }
        }

        return isValid;
    }

    // Enhanced place order button functionality
    if (placeOrderBtn) {
        placeOrderBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            let isFormValid = true;
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isFormValid = false;
                }
            });

            // Payment method validation
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
            if (!paymentMethod) {
                isFormValid = false;
                const paymentContainer = document.querySelector('.payment-method');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message mt-2 text-sm text-red-600';
                errorDiv.textContent = 'Please select a payment method';
                paymentContainer.parentNode.insertBefore(errorDiv, paymentContainer.nextSibling);
            }

            // Credit card validation if selected
            if (paymentMethod && paymentMethod.id === 'creditCard') {
                const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
                const cardName = document.getElementById('cardName').value.trim();
                const expiryDate = document.getElementById('expiryDate').value.trim();
                const cvv = document.getElementById('cvv').value.trim();
                
                if (!/^\d{16}$/.test(cardNumber)) {
                    isFormValid = false;
                    showCardError('cardNumber', 'Please enter a valid 16-digit card number');
                }
                
                if (!/^[a-zA-Z\s]{3,}$/.test(cardName)) {
                    isFormValid = false;
                    showCardError('cardName', 'Please enter the name as it appears on your card');
                }
                
                if (!/^\d{2}\/\d{2}$/.test(expiryDate)) {
                    isFormValid = false;
                    showCardError('expiryDate', 'Please enter a valid expiry date (MM/YY)');
                } else {
                    const [month, year] = expiryDate.split('/');
                    const currentYear = new Date().getFullYear() % 100;
                    const currentMonth = new Date().getMonth() + 1;
                    
                    if (parseInt(month) < 1 || parseInt(month) > 12) {
                        isFormValid = false;
                        showCardError('expiryDate', 'Please enter a valid month (01-12)');
                    } else if (parseInt(year) < currentYear || 
                              (parseInt(year) === currentYear && parseInt(month) < currentMonth)) {
                        isFormValid = false;
                        showCardError('expiryDate', 'This card has expired');
                    }
                }
                
                if (!/^\d{3,4}$/.test(cvv)) {
                    isFormValid = false;
                    showCardError('cvv', 'Please enter a valid CVV (3-4 digits)');
                }
            }

            if (isFormValid) {
                // Form is valid - proceed with order placement
                const paymentMethodName = paymentMethod.id.replace(/([A-Z])/g, ' $1').trim();
                alert(`Order placed successfully with ${paymentMethodName}!`);
                
                // In a real implementation, you would submit the form here
                // deliveryForm.submit();
                // window.location.href = '/order-confirmation';
            } else {
                // Scroll to first error
                const firstError = document.querySelector('.border-red-500');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });
    }

    function showCardError(fieldId, message) {
        const field = document.getElementById(fieldId);
        field.classList.remove('border-gray-300');
        field.classList.add('border-red-500');
        
        let errorElement = field.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('div');
            errorElement.className = 'error-message mt-1 text-sm text-red-600';
            field.parentNode.insertBefore(errorElement, field.nextSibling);
        }
        errorElement.textContent = message;
    }

    // Additional input formatting
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            e.target.value = value;
        });
    }

    const postalCodeInput = document.getElementById('postalCode');
    if (postalCodeInput) {
        postalCodeInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.substring(0, 5);
            }
            e.target.value = value;
        });
    }

    // Set minimum delivery date to today
    const deliveryDateInput = document.getElementById('deliveryDate');
    if (deliveryDateInput) {
        const today = new Date().toISOString().split('T')[0];
        deliveryDateInput.min = today;
    }


});
</script>

</body>
</html>