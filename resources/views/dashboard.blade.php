<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased bg-emerald-50">
    <!-- Navigation -->
    <nav class="bg-emerald-700 sticky top-0 z-50 shadow-lg" x-data="{ mobileMenuOpen: false }">
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
                        <a href="{{ url('flowers') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->is('flowers') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Floral Collection</a>
                        <a href="{{ url('arrangements') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->is('arrangements') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Arrangements</a>
                        <a href="{{ url('about') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->is('about') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Our Story</a>
                        <a href="{{ url('/dashboard') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->is('dashboard') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Dashboard</a>
                    </div>

                    <!-- Auth Links -->
                    <div class="flex items-center space-x-4 ml-4">
                        <a href="{{ url('checkout') }}" class="relative inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-800 hover:bg-emerald-600">
                            <i class="fas fa-shopping-cart mr-1"></i> Cart
                        </a>

                        @auth
                        <!-- Edit Mode Toggle (only for admins) -->
                        @if(Auth::user()->hasRole('admin'))
                        <div id="edit-mode-toggle-container" class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" id="edit-mode-toggle">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            <span class="ml-2 text-sm font-medium text-white">Edit Mode</span>
                        </div>
                        @endif

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="flex items-center text-sm rounded-full focus:outline-none">
                                <span class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-emerald-800 bg-white">
                                    {{ Auth::user()->name }}
                                    @if(Auth::user()->hasRole('admin'))
                                    <span class="ml-2 px-1 py-0.5 text-xs font-semibold bg-emerald-100 text-emerald-800 rounded-full">Admin</span>
                                    @elseif(Auth::user()->hasRole('supplier'))
                                    <span class="ml-2 px-1 py-0.5 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">Supplier</span>
                                    @else
                                    <span class="ml-2 px-1 py-0.5 text-xs font-semibold bg-amber-100 text-amber-800 rounded-full">Customer</span>
                                    @endif
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
                <a href="{{ url('/dashboard') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium {{ request()->is('dashboard') ? 'bg-emerald-800' : 'hover:bg-emerald-600' }}">Dashboard</a>
                
                <div class="pt-4 border-t border-emerald-800">
                    <a href="{{ url('checkout') }}" class="flex items-center px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-600">
                        <i class="fas fa-shopping-cart mr-2"></i> Cart
                    </a>
                    
                    @auth
                    @if(Auth::user()->hasRole('admin'))
                    <div class="flex items-center justify-between px-3 py-2">
                        <span class="text-white">Edit Mode</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" id="mobile-edit-mode-toggle">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-emerald-600"></div>
                        </label>
                    </div>
                    @endif
                    
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

    <!-- Dashboard Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Common Welcome Section -->
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">
                                Welcome Back, {{ Auth::user()->name }}!
                            </h2>
                            <p class="mt-2 text-emerald-600">
                                <i class="fas fa-calendar-alt mr-1"></i> {{ now()->format('l, F j, Y') }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">Last login: {{ now()->subHours(2)->format('M j, Y g:i a') }}</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                @if(Auth::user()->hasRole('admin')) bg-emerald-100 text-emerald-800
                                @elseif(Auth::user()->hasRole('supplier')) bg-blue-100 text-blue-800
                                @else bg-amber-100 text-amber-800 @endif">
                                @if(Auth::user()->hasRole('admin')) Admin
                                @elseif(Auth::user()->hasRole('supplier')) Supplier
                                @else Customer @endif
                            </span>
                        </div>
                    </div>

                    @if(Auth::user()->hasRole('admin'))
                    <!-- Admin Dashboard -->
                    <div class="admin-dashboard">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <!-- Total Sales -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Total Sales</p>
                                        <p class="text-3xl font-bold text-emerald-600">Rs. 300000</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                        <i class="fas fa-chart-line text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500"><span class="text-green-500">↑ 18%</span> from last month</p>
                            </div>

                            <!-- Inventory Items -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Inventory Items</p>
                                        <p class="text-3xl font-bold text-purple-600">142</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                        <i class="fas fa-boxes text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500"><span class="text-red-500">12 low</span> in stock</p>
                            </div>

                            <!-- Active Users -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Active Users</p>
                                        <p class="text-3xl font-bold text-blue-600">1,284</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                        <i class="fas fa-users text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500"><span class="text-green-500">24 new</span> this week</p>
                            </div>
                        </div>

                        <!-- Inventory Management -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-extrabold tracking-tight text-gray-900">Inventory Management</h3>
                                <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700">
                                    <i class="fas fa-plus mr-2"></i> Add New Item
                                </button>
                            </div>
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 bg-emerald-100 rounded-md flex items-center justify-center">
                                                            <i class="fas fa-rose text-emerald-600"></i>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">Red Rose</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">Flowers</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="text-sm text-gray-900">142</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rs 1000.00</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="#" class="text-emerald-600 hover:text-emerald-900 mr-3"><i class="fas fa-edit mr-1"></i> Edit</a>
                                                    <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash mr-1"></i> Delete</a>
                                                </td>
                                            </tr>
                                            <!-- More items would go here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Supplier Management -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-extrabold tracking-tight text-gray-900">Supplier Management</h3>
                                <button 
                                    x-data
                                    @click="$dispatch('open-modal', 'add-supplier-modal')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700"
                                >
                                    <i class="fas fa-user-plus mr-2"></i> Add Supplier
                                </button>
                            </div>
                            
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                            <i class="fas fa-truck text-blue-600"></i>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">Greenhouse Florals</div>
                                                            <div class="text-sm text-gray-500">Since 2020</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Sarah Johnson</div>
                                                    <div class="text-sm text-gray-500">sarah@greenhouse.com</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Red Roses, White Roses</div>
                                                    <div class="text-sm text-gray-500">2 active products</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit mr-1"></i> Edit</a>
                                                    <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-ban mr-1"></i> Deactivate</a>
                                                </td>
                                            </tr>
                                            <!-- More suppliers would go here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @elseif(Auth::user()->hasRole('supplier'))
                    <!-- Supplier Dashboard -->
                    <div class="supplier-dashboard">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <!-- Items Sold -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Your Items Sold</p>
                                        <p class="text-3xl font-bold text-blue-600">842</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                        <i class="fas fa-tags text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500"><span class="text-green-500">↑ 8%</span> from last month</p>
                            </div>

                            <!-- Revenue -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Revenue</p>
                                        <p class="text-3xl font-bold text-emerald-600">$5,672</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                        <i class="fas fa-dollar-sign text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500"><span class="text-green-500">↑ 15%</span> growth</p>
                            </div>

                            <!-- Top Product -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Top Product</p>
                                        <p class="text-3xl font-bold text-amber-600">Red Roses</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-amber-100 text-amber-600">
                                        <i class="fas fa-award text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">42% of your sales</p>
                            </div>
                        </div>

                        <!-- Product Performance -->
                        <div class="mb-8">
                            <h3 class="text-xl font-extrabold tracking-tight text-gray-900 mb-4">Your Product Performance</h3>
                            
                            <!-- Product Dropdown -->
                            <div class="mb-4">
                                <label for="product-select" class="block text-sm font-medium text-gray-700 mb-1">Select Product</label>
                                <select id="product-select" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md">
                                    <option>Red Roses</option>
                                    <option>Yellow Roses</option>
                                    <option>White Roses</option>
                                    <option>Red Rose Bouquet</option>
                                    <option>Mixed Bouquet</option>
                                </select>
                            </div>
                            
                            <!-- Sales Chart -->
                            <div class="bg-white p-6 border border-gray-200 rounded-lg mb-6 shadow">
                                <h4 class="text-lg font-medium text-gray-700 mb-3">Sales Trend</h4>
                                <div class="bg-gray-100 h-64 flex items-center justify-center text-gray-400 rounded-md">
                                    <i class="fas fa-chart-line text-4xl"></i>
                                    <span class="ml-2">Sales chart for selected product</span>
                                </div>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow">
                                    <h4 class="text-lg font-medium text-gray-700 mb-3">Inventory Status</h4>
                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-sm text-gray-600">Current Stock</p>
                                            <p class="text-lg font-semibold">142 units</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Reorder Level</p>
                                            <p class="text-lg font-semibold">50 units</p>
                                        </div>
                                        <button class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                            <i class="fas fa-edit mr-2"></i> Update Inventory
                                        </button>
                                    </div>
                                </div>
                                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow">
                                    <h4 class="text-lg font-medium text-gray-700 mb-3">Pricing</h4>
                                    <div class="space-y-3">
                                        <div>
                                            <p class="text-sm text-gray-600">Current Price</p>
                                            <p class="text-lg font-semibold">Rs.700.00 per unit</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Wholesale Price</p>
                                            <p class="text-lg font-semibold">Rs.500.00 per unit (50+ units)</p>
                                        </div>
                                        <button class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                            <i class="fas fa-tag mr-2"></i> Update Pricing
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else
                    <!-- Customer Dashboard -->
                    <div class="customer-dashboard">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <!-- Orders -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Orders</p>
                                        <p class="text-3xl font-bold text-amber-600">12</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-amber-100 text-amber-600">
                                        <i class="fas fa-box-open text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500"><span class="text-green-500">2 pending</span> delivery</p>
                            </div>

                            <!-- Coupons -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Coupons</p>
                                        <p class="text-3xl font-bold text-emerald-600">3</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                        <i class="fas fa-ticket-alt text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500"><span class="text-green-500">1 new</span> available</p>
                            </div>

                            <!-- Saved Items -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Saved Items</p>
                                        <p class="text-3xl font-bold text-purple-600">8</p>
                                    </div>
                                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                        <i class="fas fa-bookmark text-xl"></i>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Items you've saved</p>
                            </div>
                        </div>

                        <!-- Order History -->
                        <div class="mb-8">
                            <h3 class="text-xl font-extrabold tracking-tight text-gray-900 mb-4">Recent Orders</h3>
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#FI-7842</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 15, 2023</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0 h-10 w-10 bg-emerald-100 rounded-md flex items-center justify-center mr-2">
                                                            <i class="fas fa-rose text-emerald-600"></i>
                                                        </div>
                                                        <div>
                                                            Red Rose Bouquet<br>
                                                            <span class="text-xs text-gray-400">Qty: 1</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rs.500.00</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Delivered</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="#" class="text-emerald-600 hover:text-emerald-900"><i class="fas fa-eye mr-1"></i> View</a>
                                                </td>
                                            </tr>
                                            <!-- More orders would go here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Saved Items & Recommendations -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-xl font-extrabold tracking-tight text-gray-900 mb-4">Saved For Later</h3>
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow">
                                    <div class="flex items-center mb-3 pb-3 border-b">
                                        <div class="flex-shrink-0 h-16 w-16 bg-emerald-100 rounded-md flex items-center justify-center mr-4">
                                            <i class="fas fa-rose text-emerald-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-md font-medium">Red Roses (Dozen)</h4>
                                            <p class="text-sm text-gray-600">Rs.299.99</p>
                                        </div>
                                        <button class="ml-auto text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <!-- More saved items would go here -->
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold tracking-tight text-gray-900 mb-4">You Might Also Like</h3>
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow">
                                    <div class="flex items-center mb-3">
                                        <div class="flex-shrink-0 h-16 w-16 bg-purple-100 rounded-md flex items-center justify-center mr-4">
                                            <i class="fas fa-spa text-purple-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-md font-medium">Rose Bouquet</h4>
                                            <p class="text-sm text-gray-600">Rs.399.99</p>
                                            <button class="mt-1 text-xs text-emerald-600 hover:text-emerald-800">
                                                <i class="fas fa-plus mr-1"></i> Add to Saved Items
                                            </button>
                                        </div>
                                    </div>
                                    <!-- More recommendations would go here -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add Supplier Modal -->
    <div x-data="{ show: false }" 
         x-show="show"
         @open-modal.window="if ($event.detail === 'add-supplier-modal') show = true"
         @close-modal.window="show = false"
         class="fixed z-50 inset-0 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="show" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 transition-opacity" 
                 aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-emerald-100">
                        <i class="fas fa-user-plus text-emerald-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Supplier</h3>
                        <div class="mt-2">
                            <form class="space-y-4">
                                <div>
                                    <label for="supplier-name" class="block text-sm font-medium text-gray-700 text-left">Supplier Name</label>
                                    <input type="text" id="supplier-name" class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                
                                <div>
                                    <label for="contact-person" class="block text-sm font-medium text-gray-700 text-left">Contact Person</label>
                                    <input type="text" id="contact-person" class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 text-left">Email</label>
                                    <input type="email" id="email" class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>

                                  <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 text-left">Password</label>
                                    <input type="password" id="spassword" class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 text-left">Phone</label>
                                    <input type="tel" id="phone" class="mt-1 focus:ring-emerald-500 focus:border-emerald-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                
                                <div>
                                    <label for="products" class="block text-sm font-medium text-gray-700 text-left">Products Supplied</label>
                                    <select id="products" multiple class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-md">
                                        <option>Red Roses</option>
                                        <option>Yellow Roses</option>
                                        <option>White Roses</option>
                                        <option>Red Rose Bouquet</option>
                                        <option>Mixed Bouquet</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-emerald-600 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:col-start-2 sm:text-sm">
                        Add Supplier
                    </button>
                    <button @click="$dispatch('close-modal')" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Edit Mode Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModeToggle = document.getElementById('edit-mode-toggle');
            const mobileEditModeToggle = document.getElementById('mobile-edit-mode-toggle');
            
            function toggleEditMode(isEditMode) {
                console.log('Edit mode is now:', isEditMode);
                // Add your edit mode functionality here
                if(isEditMode) {
                    // Enable edit mode features
                    console.log('Edit mode enabled - showing editable elements');
                } else {
                    // Disable edit mode features
                    console.log('Edit mode disabled - hiding editable elements');
                }
            }
            
            if(editModeToggle) {
                editModeToggle.addEventListener('change', function() {
                    toggleEditMode(this.checked);
                    if(mobileEditModeToggle) {
                        mobileEditModeToggle.checked = this.checked;
                    }
                });
            }
            
            if(mobileEditModeToggle) {
                mobileEditModeToggle.addEventListener('change', function() {
                    toggleEditMode(this.checked);
                    if(editModeToggle) {
                        editModeToggle.checked = this.checked;
                    }
                });
            }
        });
    </script>
</body>
</html>