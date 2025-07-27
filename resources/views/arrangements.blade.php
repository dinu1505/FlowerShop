<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Artisan Arrangements</title>
    <!-- Tailwind CSS -->
     <!-- Alpine.js CDN -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased">
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
        <!-- Hero Section -->
        <section class="py-8 bg-emerald-50 border-b border-emerald-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Artisan Arrangements
                    </h1>
                    <p class="mt-3 max-w-2xl mx-auto text-lg text-gray-500">
                        Masterfully crafted floral designs to elevate every occasion and express your deepest emotions.
                    </p>
                </div>
            </div>
        </section>

        <!-- Arrangement Categories Navigation -->
        <section class="py-4 bg-white sticky top-16 z-40 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex overflow-x-auto space-x-4 pb-2">
                    <a href="#roseBouq" class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                        <i class="fas fa-heart mr-1"></i> For Your Loved Ones
                    </a>
                    <a href="#basket" class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium hover:bg-emerald-50 text-emerald-700">
                        <i class="fas fa-birthday-cake mr-1"></i> For Birthdays
                    </a>
                    <a href="#heart" class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium hover:bg-emerald-50 text-emerald-700">
                        <i class="fas fa-gem mr-1"></i> For Anniversaries
                    </a>
                </div>
            </div>
        </section>

        <!-- Arrangements Grid -->
        <section class="py-8 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Bouquets Section -->
                <div id="roseBouq" class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-2 border-b border-emerald-100">
                        <i class="fas fa-heart text-emerald-600 mr-2"></i> For Your Loved Ones
                    </h2>
                    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Red Roses Bouquet -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                Sale
                            </div>
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/red_rosebq.jpg')}}" alt="Red Roses Bouquet" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Red Roses Bouquet</h3>
                                <p class="mt-1 text-sm text-gray-500">For your special one - a dozen passionate red roses</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <div>
                                        <span class="text-sm line-through text-gray-500 mr-2">Rs.1000.00</span>
                                        <span class="text-base font-bold text-emerald-600">Rs.899.99</span>
                                    </div>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Yellow Roses Bouquet -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/yellow_boq.jpg')}}" alt="Yellow Roses Bouquet" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Yellow Roses Bouquet</h3>
                                <p class="mt-1 text-sm text-gray-500">For your closer ones - cheerful yellow blooms</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-base font-bold text-emerald-600">Rs.799.99</span>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Mixed Bouquet -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                New
                            </div>
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/ct_rose.jpg')}}" alt="Mixed Bouquet" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Mixed Bouquet</h3>
                                <p class="mt-1 text-sm text-gray-500">For special occasions - a vibrant mix of blooms</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-base font-bold text-emerald-600">Rs.900.00</span>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Baskets Section -->
                <div id="basket" class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-2 border-b border-emerald-100">
                        <i class="fas fa-birthday-cake text-emerald-600 mr-2"></i> For Birthdays
                    </h2>
                    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Rose Basket -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/roseb.jpg')}}" alt="Rose Basket" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Rose Basket</h3>
                                <p class="mt-1 text-sm text-gray-500">Elegant rose basket to surprise anyone special</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-base font-bold text-emerald-600">Rs.1500.00</span>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Carnation Basket -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/carnatiob.jpg')}}" alt="Carnation Basket" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Carnation Basket</h3>
                                <p class="mt-1 text-sm text-gray-500">Beautiful carnations arranged for happiness</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-base font-bold text-emerald-600">Rs.850.00</span>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Mixed Basket -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                Sale
                            </div>
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/mixb.jpg')}}" alt="Mixed Basket" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Mixed Basket</h3>
                                <p class="mt-1 text-sm text-gray-500">Colorful flowers in a beautifully woven basket</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <div>
                                        <span class="text-sm line-through text-gray-500 mr-2">Rs.800.00</span>
                                        <span class="text-base font-bold text-emerald-600">Rs.650.00</span>
                                    </div>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hearts Section -->
                <div id="heart">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-2 border-b border-emerald-100">
                        <i class="fas fa-gem text-emerald-600 mr-2"></i> For Anniversaries
                    </h2>
                    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Red Rose Heart -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/redroseH.jpg')}}" alt="Red Rose Heart" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Red Rose Heart</h3>
                                <p class="mt-1 text-sm text-gray-500">For your love ones - a heart filled with passion</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-base font-bold text-emerald-600">Rs.5000.00</span>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Yellow Rose Heart -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                New
                            </div>
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/yellowroseH.jpg')}}" alt="Yellow Rose Heart" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Yellow Rose Heart</h3>
                                <p class="mt-1 text-sm text-gray-500">Filled with love and cheerful memories</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-base font-bold text-emerald-600">Rs.6000.00</span>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>

                        <!-- Big Heart -->
                        <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs font-bold px-2 py-1 rounded-full z-10">
                                New
                            </div>
                            <div class="h-64 w-full overflow-hidden">
                                <img src="{{asset('images/bigH.jpg')}}" alt="Big Heart" class="w-full h-full object-cover group-hover:opacity-90 transition-opacity duration-300">
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-medium text-gray-900">Big Heart</h3>
                                <p class="mt-1 text-sm text-gray-500">Show your love with this grand floral heart</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-base font-bold text-emerald-600">Rs.10,000.00</span>
                                    <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-full text-sm font-medium text-emerald-600 hover:bg-emerald-50">
                                        <i class="fas fa-plus mr-1"></i> Add
                                    </button>
                                </div>
                                <button class="mt-2 w-full py-1.5 px-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <button class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>
                            Previous
                        </button>
                        <button class="inline-flex items-center px-3 py-1 border border-emerald-600 rounded-md text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                            1
                        </button>
                        <button class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            2
                        </button>
                        <button class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            3
                        </button>
                        <button class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </button>
                    </nav>
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

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
                mobileMenu.classList.toggle('hidden');
            });

            // Dropdown toggle for user menu
            const userMenuButton = document.getElementById('user-menu-button');
            if(userMenuButton) {
                const userMenu = userMenuButton.nextElementSibling;
                
                userMenuButton.addEventListener('click', function() {
                    const expanded = this.getAttribute('aria-expanded') === 'true';
                    this.setAttribute('aria-expanded', !expanded);
                    userMenu.classList.toggle('hidden');
                });
            }

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