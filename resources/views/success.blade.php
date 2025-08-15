<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiora - Payment Successful</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .success-icon {
            font-size: 5rem;
            color: #28a745;
            margin-bottom: 1.5rem;
            animation: bounce 1s infinite alternate;
        }
        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-15px); }
        }
        .success-card {
            border-top: 5px solid #28a745;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.2);
        }
        .btn-home {
            transition: all 0.3s ease;
        }
        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card success-card border-0 text-center py-5">
                    <div class="card-body">
                        <div class="success-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h2 class="card-title text-success mb-3">Payment Successful</h2>
                        <p class="card-text fs-5 mb-4">Your order has been placed successfully!</p>
                        <p class="text-muted mb-4">
                            <i class="fas fa-receipt me-2"></i>Order confirmation has been sent to your email
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('index') }}" class="btn btn-success btn-home px-4 py-2">
                                <i class="fas fa-home me-2"></i>Back to Home
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <h5 class="mb-3">Need Help?</h5>
                    <div class="d-flex justify-content-center gap-4">
                        <a href="#" class="text-decoration-none">
                            <i class="fas fa-phone-alt me-2 text-success"></i>Contact Support
                        </a>
                        <a href="#" class="text-decoration-none">
                            <i class="fas fa-question-circle me-2 text-success"></i>FAQs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>