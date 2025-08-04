<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Fiora</title>
    <!-- Alpine.js CDN -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- User Info Form -->
        <form id="checkoutForm" action="{{ route('order.place') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8">
            @csrf
            <h2 class="text-xl font-bold text-gray-800 mb-4">Delivery Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="Full Name" class="border rounded p-2" required>
                <input type="email" name="email" placeholder="Email" class="border rounded p-2" required>
                <input type="text" name="phone" placeholder="Phone Number" class="border rounded p-2" required>
                <input type="text" name="address" placeholder="Delivery Address" class="border rounded p-2 col-span-2" required>
            </div>
        </form>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Side: Selected Items -->
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Your Bouquets</h2>
                @foreach ($bouquets as $item)
                    <div class="flex items-center justify-between border-b py-4">
                        <div class="flex items-center">
                            <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->product_name }}" class="h-20 w-20 object-cover rounded">
                            <div class="ml-4">
                                <p class="font-semibold text-gray-800">{{ $item->product_name }}</p>
                                <p class="text-gray-600">Rs. {{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button type="button" class="decrement bg-gray-200 px-2 py-1 rounded" data-id="{{ $item->id }}">-</button>
                            <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="w-12 text-center border rounded">
                            <button type="button" class="increment bg-gray-200 px-2 py-1 rounded" data-id="{{ $item->id }}">+</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right Side: Bill -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Bill Summary</h2>
                <div class="text-gray-700">
                    <p class="mb-2">Subtotal: <span id="subtotal">Rs. 0.00</span></p>
                    <p class="mb-2">Delivery: <span>Rs. 150.00</span></p>
                    <hr class="my-2">
                    <p class="text-lg font-bold">Total: <span id="total">Rs. 0.00</span></p>
                </div>
                <button onclick="submitCheckout()" class="mt-4 w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 px-4 rounded">
                    Proceed to Pay
                </button>
            </div>
        </div>
    </div>

    <script>
        const updateBill = () => {
            let subtotal = 0;
            document.querySelectorAll('input[name^="quantities"]').forEach(input => {
                const price = parseFloat(input.closest('.flex.items-center.justify-between').querySelector('p.text-gray-600').textContent.replace('Rs.', ''));
                const quantity = parseInt(input.value);
                subtotal += price * quantity;
            });
            document.getElementById('subtotal').textContent = 'Rs. ' + subtotal.toFixed(2);
            document.getElementById('total').textContent = 'Rs. ' + (subtotal + 150).toFixed(2);
        }

        document.querySelectorAll('.increment').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.parentElement.querySelector('input');
                input.value = parseInt(input.value) + 1;
                updateBill();
            });
        });

        document.querySelectorAll('.decrement').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.parentElement.querySelector('input');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    updateBill();
                }
            });
        });

        window.onload = updateBill;

        function submitCheckout() {
            const form = document.getElementById('checkoutForm');
            form.submit();
        }
    </script>
</body>
</html>
