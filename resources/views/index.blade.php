<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Blossom Heaven</title>

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

    <!-- Hero Section -->
    <header class="bg-emerald-50 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                <div class="sm:text-center md:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Nature's Poetry in</span>
                        <span class="block text-emerald-600">Every Flowers</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Where floral dreams take root and blossom into breathtaking realities. Handcrafted arrangements delivered with care to your sanctuary.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center md:justify-start">
                        <div class="rounded-md shadow">
                            <a href="{{url('/flowers')}}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 md:py-4 md:text-lg md:px-10">
                                Discover Blooms
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#featured" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-emerald-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                                Seasonal Specials
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0">
                    <div class="relative rounded-lg shadow-lg overflow-hidden transform rotate-1">
                        <img class="object-cover w-full h-96 rounded-lg" src="{{asset('images/bouquet.jpg')}}" alt="Masterpiece bouquet from Fiora">
                        <div class="absolute inset-0 bg-emerald-900 bg-opacity-50 mix-blend-multiply rounded-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Featured Categories -->
    <section id="featured" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Our Botanical Treasures
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Curated collections for every sentiment and celebration
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Rose Category -->
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none relative">
                            <img src="{{asset('images/ct_rose.jpg')}}" alt="Timeless roses collection" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">BESTSELLER</span>
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-lg text-gray-700">
                                    <a href="{{ url('flowers#rose') }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        The Timeless Rose Collection
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Elegance perfected in every petal</p>
                            </div>
                        </div>
                        <a href="{{ url('flowers#rose') }}" class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                            Explore Roses <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Colorful Flowers -->
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img src="{{asset('images/ct_tulip.jpg')}}" alt="Vibrant blooms collection" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-lg text-gray-700">
                                    <a href="{{ url('flowers#otherfl') }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Vibrant Blooms Collection
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Nature's most joyful color palette</p>
                            </div>
                        </div>
                        <a href="{{ url('flowers#otherfl') }}" class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                            Explore Flowers <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Lotus -->
                    <div class="group relative">
                        <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                            <img src="{{asset('images/ct_lotus.jpg')}}" alt="Serene lotus collection" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-lg text-gray-700">
                                    <a href="{{ url('flowers#lotus') }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        Serene Lotus Collection
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">Purity and enlightenment embodied</p>
                            </div>
                        </div>
                        <a href="{{ url('flowers#lotus') }}" class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                            Explore Lotus <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Arrangements -->
    <section class="py-12 bg-emerald-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                    Signature Arrangements
                </h2>
                <a href="{{ url('arrangements') }}" class="mt-4 md:mt-0 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700">
                    <i class="fas fa-spa mr-2"></i> View All Masterpieces
                </a>
            </div>

            <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Rose Bouquet -->
                <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-72 w-full overflow-hidden">
                        <img src="{{asset('images/red_rosebq.jpg')}}" alt="Enchanted rose bouquet" class="w-full h-full object-cover object-center group-hover:opacity-90 transition-opacity duration-300">
                        <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">BESTSELLER</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">
                                Enchanted Rose Bouquet
                            </h3>
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">A symphony of romance in every stem</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm font-medium text-emerald-600">From $45</span>
                            <a href="{{url('arrangements#roseBouq')}}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-emerald-600 hover:bg-emerald-700">
                                <i class="fas fa-eye mr-1"></i> Preview
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Flower Basket -->
                <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-72 w-full overflow-hidden">
                        <img src="{{asset('images/flower-basket.jpg')}}" alt="Rustic charm flower basket" class="w-full h-full object-cover object-center group-hover:opacity-90 transition-opacity duration-300">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">
                                Rustic Charm Basket
                            </h3>
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Countryside elegance in woven splendor</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm font-medium text-emerald-600">From $38</span>
                            <a href="{{ url('arrangements#basket') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-emerald-600 hover:bg-emerald-700">
                                <i class="fas fa-eye mr-1"></i> Preview
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Heart Shape -->
                <div class="group relative bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-72 w-full overflow-hidden">
                        <img src="{{asset('images/heart.jpg')}}" alt="Whispering heart floral arrangement" class="w-full h-full object-cover object-center group-hover:opacity-90 transition-opacity duration-300">
                        <div class="absolute top-2 left-2 bg-pink-500 text-white text-xs font-bold px-2 py-1 rounded-full">ROMANTIC</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">
                                Whispering Heart
                            </h3>
                            <div class="flex text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Love's language in floral form</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm font-medium text-emerald-600">From $52</span>
                            <a href="{{ url('arrangements#heart') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-emerald-600 hover:bg-emerald-700">
                                <i class="fas fa-eye mr-1"></i> Preview
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    The Fiora Difference
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Why discerning flower lovers choose our botanical artistry
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Same-Day Delivery -->
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                            <i class="fas fa-bolt text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Lightning Delivery</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Order by noon for same-day floral magic delivered to their door. Our petal couriers never miss a beat.
                        </p>
                    </div>

                    <!-- Fresh Flowers -->
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                            <i class="fas fa-leaf text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Farm-Fresh Petals</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Harvested at peak perfection, our blooms arrive fresher than morning dew with unparalleled longevity.
                        </p>
                    </div>

                    <!-- Satisfaction Guaranteed -->
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-4">
                            <i class="fas fa-heart text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Bliss Guarantee</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Your delight is our promise - we'll move heaven and earth to ensure every arrangement sparks joy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
        Alpine.data('mobileMenuOpen', false);
    });
     
    </script>
</body>
</html>