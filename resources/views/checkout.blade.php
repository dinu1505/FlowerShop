<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Checkout</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .cart-item {
            transition: all 0.3s ease;
            border-left: 4px solid #28a745;
        }
        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .empty-cart-icon {
            font-size: 5rem;
            color: #6c757d;
            opacity: 0.5;
        }
        .form-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
        }
        .total-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }
        .invalid-feedback {
            display: none;
            color: #dc3545;
        }
        .was-validated .form-control:invalid ~ .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-success"><i class="fas fa-shopping-cart me-2"></i>Checkout</h2>
                
                @if($cartItems->isEmpty())
                    <div class="text-center py-5">
                        <div class="empty-cart-icon mb-3">
                            <i class="fas fa-shopping-basket"></i>
                        </div>
                        <h4 class="text-muted">Your cart is empty</h4>
                        <p class="text-muted">Start shopping to add items to your cart</p>
                        <a href="{{ route('flowers') }}" class="btn btn-success mt-3">
                            <i class="fas fa-leaf me-2"></i>Browse Flowers
                        </a>
                    </div>
                @else
                    <!-- Cart Items -->
                    <div class="row mb-4">
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            @php $total += $item->qty * $item->price; @endphp
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 cart-item">
                                    <img src="{{ asset('images/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Quantity:</span>
                                            <span class="fw-bold">{{ $item->qty }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Price:</span>
                                            <span>Rs.{{ number_format($item->price, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span>Total:</span>
                                            <span class="fw-bold text-success">Rs.{{ number_format($item->qty * $item->price, 2) }}</span>
                                        </div>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm w-100">
                                                <i class="fas fa-trash-alt me-1"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Order Total:</h5>
                                        <span class="total-amount">Rs.{{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Details Form -->
                    <div class="form-section">
                        <h4 class="mb-4"><i class="fas fa-user-circle me-2"></i>Customer Details</h4>
                        
                        <form id="checkoutForm" action="{{ route('checkout.place') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="total" value="{{ $total }}">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                    <div class="invalid-feedback">
                                        Please provide your full name.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                <div class="invalid-feedback">
                                    Please provide your phone number.
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Delivery Address *</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Please provide your delivery address.
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="notes" class="form-label">Special Instructions</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                                <small class="text-muted">Any special delivery instructions?</small>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('flowers') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                                </a>
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-lock me-2"></i>Proceed to Payment
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Form validation
        (function () {
            'use strict'
            
            const form = document.getElementById('checkoutForm')
            
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                
                form.classList.add('was-validated')
            }, false)
        })()
    </script>
</body>
</html>