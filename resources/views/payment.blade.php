<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Payment Gateway</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-input {
            position: relative;
        }
        .card-input i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 15px;
            color: #6c757d;
        }
        .card-input input {
            padding-left: 40px;
        }
        .card-icon {
            height: 24px;
        }
        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>Payment Gateway</h4>
                    </div>
                    
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-user me-2"></i>Name:</strong> {{ session('customer_name') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong><i class="fas fa-envelope me-2"></i>Email:</strong> {{ session('customer_email') }}</p>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <h5 class="alert-heading">Order Summary</h5>
                            <hr>
                            <p class="mb-0"><strong>Total Amount:</strong> <span class="fs-4 text-success">Rs.{{ session('cart_total') }}</span></p>
                        </div>

                        <form id="paymentForm" action="{{ route('payment.process') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="total" value="{{ session('cart_total') }}">
                            
                            <h5 class="mb-3"><i class="fas fa-credit-card me-2"></i>Credit Card Details</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Card Number</label>
                                <div class="card-input">
                                    <i class="far fa-credit-card"></i>
                                    <input type="text" class="form-control" id="cardNumber" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19">
                                    <div id="cardNumberError" class="error"></div>
                                    <div class="mt-2">
                                        <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" class="card-icon me-2">
                                        <img src="https://cdn-icons-png.flaticon.com/512/196/196561.png" class="card-icon me-2">
                                        <img src="https://cdn-icons-png.flaticon.com/512/196/196566.png" class="card-icon">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Expiration Date</label>
                                    <input type="text" class="form-control" id="expiryDate" name="expiry_date" placeholder="MM/YY" maxlength="5">
                                    <div id="expiryDateError" class="error"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">CVV</label>
                                    <div class="card-input">
                                        <i class="fas fa-lock"></i>
                                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" maxlength="4">
                                        <div id="cvvError" class="error"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Cardholder Name</label>
                                <input type="text" class="form-control" id="cardName" name="card_name" placeholder="Name on card">
                                <div id="cardNameError" class="error"></div>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-lock me-2"></i>Pay Rs.{{ session('cart_total') }}
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Cart
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentForm = document.getElementById('paymentForm');
            const cardNumber = document.getElementById('cardNumber');
            const expiryDate = document.getElementById('expiryDate');
            const cvv = document.getElementById('cvv');
            const cardName = document.getElementById('cardName');
            
            // Format card number with spaces
            cardNumber.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\s+/g, '');
                if (value.length > 0) {
                    value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
                }
                e.target.value = value;
            });
            
            // Format expiry date
            expiryDate.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                e.target.value = value;
            });
            
            // Validate form on submit
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                let isValid = true;
                
                // Reset errors
                document.querySelectorAll('.error').forEach(el => el.textContent = '');
                
                // Validate card number (16 digits)
                if (!/^\d{16}$/.test(cardNumber.value.replace(/\s/g, ''))) {
                    document.getElementById('cardNumberError').textContent = 'Please enter a valid 16-digit card number';
                    isValid = false;
                }
                
                // Validate expiry date (MM/YY format and not expired)
                if (!/^\d{2}\/\d{2}$/.test(expiryDate.value)) {
                    document.getElementById('expiryDateError').textContent = 'Please enter a valid expiry date (MM/YY)';
                    isValid = false;
                } else {
                    const [month, year] = expiryDate.value.split('/');
                    const currentYear = new Date().getFullYear() % 100;
                    const currentMonth = new Date().getMonth() + 1;
                    
                    if (month < 1 || month > 12) {
                        document.getElementById('expiryDateError').textContent = 'Invalid month';
                        isValid = false;
                    } else if (year < currentYear || (year == currentYear && month < currentMonth)) {
                        document.getElementById('expiryDateError').textContent = 'Card has expired';
                        isValid = false;
                    }
                }
                
                // Validate CVV (3 or 4 digits)
                if (!/^\d{3,4}$/.test(cvv.value)) {
                    document.getElementById('cvvError').textContent = 'Please enter a valid CVV (3 or 4 digits)';
                    isValid = false;
                }
                
                // Validate cardholder name
                if (cardName.value.trim() === '') {
                    document.getElementById('cardNameError').textContent = 'Please enter cardholder name';
                    isValid = false;
                }
                
                if (isValid) {
                    paymentForm.submit();
                }
            });
        });
    </script>
</body>
</html>