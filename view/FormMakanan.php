<?php
function getPlaceholder($kategori) {
    switch($kategori) {
        case "Protein":
            return 'e.g., ayam goreng, rendang, telor dadar...';
        case "Karbohidrat":
            return 'e.g., nasi putih, roti, pasta...';
        case "Sayuran":
            return 'e.g., broccoli, spinach, carrot...';
        default:
            return 'e.g., food item...';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calories Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="jquery.js"></script>
    <script src="script.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 600px;
            margin: 2rem auto;
            padding: 2.5rem;
            position: relative;
            overflow: visible;
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .category-header {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }
        .suggestions-dropdown {
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
            z-index: 1000;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }
        .suggestion-item:hover {
            background-color: #f5f5f5;
        }

        .category-title {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .category-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            font-weight: 400;
        }
        
        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
            transform: translateY(-1px);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group-text {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: 2px solid #667eea;
            border-left: none;
            border-radius: 0 12px 12px 0;
            font-weight: 600;
        }
        
        .autocomplete-container {
            position: relative;
        }
        
        .autocomplete-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #e9ecef;
            border-top: none;
            border-radius: 0 0 12px 12px;
            min-height: 250px;
            max-height: 400px;
            overflow-y: auto;
            z-index: 9999;
            display: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        }
        
        .autocomplete-suggestion {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .autocomplete-suggestion:hover,
        .autocomplete-suggestion.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
        
        .autocomplete-suggestion:last-child {
            border-bottom: none;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        .submit-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }
        
        .submit-btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
        }
        
        .floating-label {
            position: relative;
        }
        
        .floating-label input {
            padding-top: 1.5rem;
            padding-bottom: 0.5rem;
        }
        
        .floating-label label {
            position: absolute;
            top: 0.75rem;
            left: 1rem;
            background: white;
            padding: 0 0.5rem;
            color: #6c757d;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        
        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            top: -0.5rem;
            font-size: 0.8rem;
            color: #667eea;
            font-weight: 600;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        .success-message {
            color: #28a745;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        /* Mobile First Responsive Design */
        @media (max-width: 576px) {
            body {
                padding: 0.5rem;
            }
            
            .form-container {
                margin: 0.5rem;
                padding: 1.5rem 1rem;
                border-radius: 15px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            }
            
            .category-title {
                font-size: 1.4rem;
                line-height: 1.3;
            }
            
            .category-subtitle {
                font-size: 0.95rem;
            }
            
            .category-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
            
            .form-control {
                padding: 0.7rem 0.8rem;
                font-size: 0.95rem;
            }
            
            .form-label {
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }
            
            .input-group-text {
                padding: 0.7rem 0.8rem;
                font-size: 0.9rem;
            }
            
            .submit-btn {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
            
            .autocomplete-suggestion {
                padding: 0.6rem 0.8rem;
                font-size: 0.9rem;
            }
            
            .form-group {
                margin-bottom: 1.5rem;
            }
        }
        
        @media (min-width: 577px) and (max-width: 768px) {
            .form-container {
                margin: 1rem;
                padding: 2rem 1.5rem;
                max-width: 90%;
            }
            
            .category-title {
                font-size: 1.6rem;
            }
            
            .category-subtitle {
                font-size: 1rem;
            }
        }
        
        @media (min-width: 769px) and (max-width: 992px) {
            .form-container {
                max-width: 700px;
                margin: 2rem auto;
            }
            
            .category-title {
                font-size: 1.8rem;
            }
        }
        
        @media (min-width: 993px) and (max-width: 1200px) {
            .form-container {
                max-width: 650px;
            }
        }
        
        /* Large screens */
        @media (min-width: 1201px) {
            .form-container {
                max-width: 600px;
            }
        }
        
        /* Landscape mobile optimization */
        @media (max-height: 500px) and (orientation: landscape) {
            .form-container {
                margin: 0.5rem auto;
                padding: 1rem;
            }
            
            .category-header {
                margin-bottom: 1rem;
            }
            
            .category-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            
            .category-title {
                font-size: 1.2rem;
                margin-bottom: 0.2rem;
            }
            
            .category-subtitle {
                font-size: 0.85rem;
            }
            
            .form-group {
                margin-bottom: 1rem;
            }
        }
        
        /* Touch-friendly improvements */
        @media (hover: none) and (pointer: coarse) {
            .form-control {
                min-height: 48px;
                font-size: 16px; /* Prevents zoom on iOS */
            }
            
            .submit-btn {
                min-height: 48px;
                font-size: 16px;
            }
            
            .autocomplete-suggestion {
                min-height: 44px;
                display: flex;
                align-items: center;
            }
            
            .input-group-text {
                min-height: 48px;
                display: flex;
                align-items: center;
            }
        }
        
        /* High DPI displays */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .form-container {
                border-width: 0.5px;
            }
            
            .form-control {
                border-width: 1px;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            }
            
            .form-container {
                background: rgba(44, 62, 80, 0.95);
                color: #ecf0f1;
            }
            
            .form-control {
                background: rgba(52, 73, 94, 0.8);
                color: #ecf0f1;
                border-color: #5a6c7d;
            }
            
            .form-control:focus {
                background: rgba(52, 73, 94, 1);
                color: #ecf0f1;
            }
            
            .autocomplete-suggestions {
                background: #2c3e50;
                border-color: #5a6c7d;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            }
            
            .autocomplete-suggestion {
                color: #ecf0f1;
                border-color: #5a6c7d;
            }
            
            .form-label {
                color: #bdc3c7;
            }
            
            .category-subtitle {
                color: #95a5a6;
            }
        }
        
        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            
            .form-container::before {
                animation: none;
            }
        }
    </style>
</head>
<body>
    <?php @include "header.php";?>

    <div class="container-fluid p-0">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8 col-xl-6 col-xxl-5">
                <div class="form-container">
                    <!-- Category Header with Icon -->
                    <div class="category-header">
                        <div class="category-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h1 class="category-title" id="kategori"><?php echo $kategori?> Tracker</h1>
                        <p class="category-subtitle">Track your daily <?php echo $kategori?> intake</p>
                    </div>
                    
                    <form id="caloriesForm" action="?c=Calories&m=result" method="POST">
                        <!-- Food Input with Floating Label -->
                        <div class="form-group">
                            <label for="konsumsi" class="form-label">
                                <i class="fas fa-search"></i>
                                <span class="d-none d-sm-inline">What did you consume?</span>
                                <span class="d-sm-none">Food item</span>
                            </label>
                            <div class="autocomplete-container">
                                <input name="konsumsi" type="text" class="form-control" 
                                       id="konsumsi" placeholder="<?php echo htmlspecialchars(getPlaceholder($kategori)) ?>"
                                       autocomplete="off" required>
                                <div id="suggestions" class="suggestions-dropdown"></div>
                                <!-- <div class="error-message" id="konsumsi-error">Please enter a food item</div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="berat" class="form-label">
                                <i class="fas fa-weight"></i>
                                <span class="d-none d-sm-inline">How much did you consume?</span>
                                <span class="d-sm-none">Weight</span>
                            </label>
                            <div class="input-group">
                                <input name="berat" type="number" class="form-control" 
                                       id="berat" min="1" step="1" placeholder="Enter weight..."
                                       required>
                                <span class="input-group-text">
                                    <span class="d-none d-sm-inline">grams</span>
                                    <span class="d-sm-none">gr</span>
                                </span>
                            </div>
                            <div class="error-message" id="berat-error">Please enter a valid weight</div>
                        </div>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-calculator me-2"></i>
                            <span class="d-none d-sm-inline">Calculate Calories</span>
                            <span class="d-sm-none">Calculate</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        // Form validation
        const form = document.getElementById('caloriesForm');
        const konsumsiError = document.getElementById('konsumsi-error');
        const beratInput = document.getElementById('berat');
        const beratError = document.getElementById('berat-error');
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validate konsumsi input
            if (!konsumsiInput.value.trim()) {
                konsumsiError.style.display = 'block';
                konsumsiInput.style.borderColor = '#dc3545';
                isValid = false;
            } else {
                konsumsiError.style.display = 'none';
                konsumsiInput.style.borderColor = '#28a745';
            }
            
            // Validate berat input
            if (!beratInput.value || beratInput.value <= 0) {
                beratError.style.display = 'block';
                beratInput.style.borderColor = '#dc3545';
                isValid = false;
            } else {
                beratError.style.display = 'none';
                beratInput.style.borderColor = '#28a745';
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        // Reset error states on input
        konsumsiInput.addEventListener('input', function() {
            if (this.value.trim()) {
                konsumsiError.style.display = 'none';
                this.style.borderColor = '#e9ecef';
            }
        });
        
        beratInput.addEventListener('input', function() {
            if (this.value > 0) {
                beratError.style.display = 'none';
                this.style.borderColor = '#e9ecef';
            }
        });
        
        // Add loading state to submit button
        form.addEventListener('submit', function() {
            const submitBtn = document.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Calculating...';
            submitBtn.disabled = true;
            
            });
    </script>
</body>
</html>