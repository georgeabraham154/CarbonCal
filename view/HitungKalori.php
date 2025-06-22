<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calories Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
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
            padding: 3rem;
            max-width: 600px;
            width: 100%;
        }
        
        .main-title {
            text-align: center;
            margin-bottom: 3rem;
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
        }
        
        .category-grid {
            display: grid;
            gap: 1.5rem;
        }
        
        .category-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border: 2px solid #e9ecef;
            border-radius: 20px;
            padding: 2rem;
            text-decoration: none;
            color: #2c3e50;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .category-card:hover {
            transform: translateY(-8px);
            border-color: #667eea;
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
            text-decoration: none;
            color: #2c3e50;
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
            transition: transform 0.3s ease;
        }
        
        .category-card:hover .category-icon {
            transform: scale(1.1);
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
        
        
            /* Mobile Responsive */
            @media (max-width: 576px) {
                main {
                    padding: 1rem;
                }
            
            .category-container {
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
    </style>
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
    <script>
        function toggleMenu() {
            let menu = document.getElementById("menuDropdown");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById("menuDropdown");
            const trigger = event.target.closest('[onclick*="toggleMenu"]');
            
            if (!trigger && menu && menu.style.display === "block") {
                menu.style.display = "none";
            }
        });
    </script>
</body>
</html>