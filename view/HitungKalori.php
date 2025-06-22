<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calories Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .category-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
            max-width: 600px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .category-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 4s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .main-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            z-index: 1;
        }
        
        .title-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .main-heading {
            font-size: 2.2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }
        
        .main-subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            font-weight: 400;
        }
        
        .category-grid {
            display: grid;
            gap: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .category-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border: 2px solid #e9ecef;
            border-radius: 20px;
            padding: 2rem;
            text-decoration: none;
            color: #2c3e50;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .category-card:hover::before {
            left: 100%;
        }
        
        .category-card:hover {
            transform: translateY(-8px);
            border-color: #667eea;
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
            text-decoration: none;
            color: #2c3e50;
        }
        
        .category-card:active {
            transform: translateY(-4px);
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        
        .category-card:hover .category-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .protein-icon {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        }
        
        .carb-icon {
            background: linear-gradient(135deg, #feca57, #ff9ff3);
        }
        
        .vegetable-icon {
            background: linear-gradient(135deg, #48cab2, #2ed573);
        }
        
        .category-title {
            font-size: 1.4rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        
        .category-description {
            font-size: 0.9rem;
            color: #6c757d;
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .category-arrow {
            text-align: center;
            color: #667eea;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }
        
        .category-card:hover .category-arrow {
            transform: translateX(5px);
        }
        
        .menu-dropdown {
            display: none;
            position: fixed;
            right: 10px;
            top: 60px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 15px;
            z-index: 1050;
        }
        
        .menu-dropdown button {
            display: block;
            width: 100%;
            background: none;
            border: none;
            padding: 12px 15px;
            text-align: left;
            border-radius: 10px;
            transition: all 0.3s ease;
            color: #2c3e50;
        }
        
        .menu-dropdown button:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: translateX(5px);
        }
        
        /* Mobile Responsive */
        @media (max-width: 576px) {
            .category-container {
                margin: 1rem;
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }
            
            .main-heading {
                font-size: 1.8rem;
            }
            
            .main-subtitle {
                font-size: 1rem;
            }
            
            .title-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .category-card {
                padding: 1.5rem;
            }
            
            .category-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
            
            .category-title {
                font-size: 1.2rem;
            }
        }
        
        @media (min-width: 577px) and (max-width: 768px) {
            .category-container {
                margin: 1.5rem;
                padding: 2.5rem 2rem;
            }
        }
        
        /* Touch devices */
        @media (hover: none) and (pointer: coarse) {
            .category-card {
                padding: 1.8rem;
            }
            
            .category-card:active {
                transform: scale(0.98);
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            }
            
            .category-container {
                background: rgba(44, 62, 80, 0.95);
                color: #ecf0f1;
            }
            
            .category-card {
                background: linear-gradient(135deg, #34495e, #2c3e50);
                border-color: #5a6c7d;
                color: #ecf0f1;
            }
            
            .category-card:hover {
                border-color: #667eea;
                color: #ecf0f1;
            }
            
            .main-subtitle, .category-description {
                color: #bdc3c7;
            }
            
            .menu-dropdown {
                background: rgba(44, 62, 80, 0.95);
                border-color: #5a6c7d;
            }
            
            .menu-dropdown button {
                color: #ecf0f1;
            }
        }
        
        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            
            .category-container::before {
                animation: none;
            }
        }
    </style>
    <script>
        function toggleMenu() {
            let menu = document.getElementById("menuDropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
        
        // Add click effects
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.category-card');
            
            cards.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(102, 126, 234, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
        
        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</head>
<body>
    <?php @include "header.php";?>

    <main>
        <div class="category-container">
            <div class="main-title">
                <div class="title-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h1 class="main-heading">Calories Calculator</h1>
                <p class="main-subtitle">Pilih kategori makanan untuk mulai melacak kalorimu!</p>
            </div>
            
            <div class="category-grid">
                <a href="?c=Calories&m=form&kategori=Protein" class="category-card">
                    <div class="category-icon protein-icon">
                        <i class="fas fa-drumstick-bite"></i>
                    </div>
                    <h3 class="category-title">Protein</h3>
                    <p class="category-description">Daging merah, ayam, ikan, dan makanan lain tinggi protein</p>
                    <div class="category-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
                
                <a href="?c=Calories&m=form&kategori=Karbohidrat" class="category-card">
                    <div class="category-icon carb-icon">
                        <i class="fas fa-bread-slice"></i>
                    </div>
                    <h3 class="category-title">Karbohidrat</h3>
                    <p class="category-description">nasi goreng, mie goreng, dan lainnya yang merupakan sumber karbohidrat</p>
                    <div class="category-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
                
                <a href="?c=Calories&m=form&kategori=Sayuran" class="category-card">
                    <div class="category-icon vegetable-icon">
                        <i class="fas fa-carrot"></i>
                    </div>
                    <h3 class="category-title">Sayuran</h3>
                    <p class="category-description">Olahan masakan dengan komponen utama yaitu sayuran</p>
                    <div class="category-arrow">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </main>
    
    <?php @include "footer.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>