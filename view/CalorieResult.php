<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calorie Calculator Results</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .results-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718096;
            font-size: 1.1rem;
        }

        .food-icon {
            font-size: 4rem;
            margin-bottom: 15px;
            display: block;
        }

        .results-grid {
            display: grid;
            gap: 20px;
            margin-bottom: 30px;
        }

        .result-item {
            background: linear-gradient(145deg, #f7fafc, #edf2f7);
            border-radius: 15px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .result-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .result-label {
            font-weight: 600;
            color: #4a5568;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .result-value {
            font-weight: 700;
            font-size: 1.2rem;
            margin-right: 0;
            color: #2d3748;
        }

        .total-calories {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border: none;
            margin-top: 10px;
        }

        .total-calories .result-label,
        .total-calories .result-value {
            color: white;
        }

        .total-calories .result-value {
            font-size: 1.8rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .icon {
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.9);
            color: #4a5568;
            border: 2px solid rgba(226, 232, 240, 0.8);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .progress-ring {
            width: 120px;
            height: 120px;
            margin: 20px auto;
            position: relative;
        }

        .progress-ring svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .progress-ring circle {
            fill: none;
            stroke-width: 8;
        }

        .progress-ring .bg {
            stroke: rgba(226, 232, 240, 0.5);
        }

        .progress-ring .progress {
            stroke: url(#gradient);
            stroke-linecap: round;
            stroke-dasharray: 314;
            stroke-dashoffset: 157;
            animation: progressAnimation 1.5s ease-out forwards;
        }

        @keyframes progressAnimation {
            to {
                stroke-dashoffset: 78.5;
            }
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-weight: 700;
            color: #2d3748;
        }

        .progress-number {
            font-size: 1.5rem;
            display: block;
        }

        .progress-label {
            font-size: 0.8rem;
            color: #718096;
        }

        @media (max-width: 480px) {
            .results-container {
                padding: 30px 20px;
            }
            
            .title {
                font-size: 1.8rem;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }

            .result-value .result-label{
                font-size: x-large;
            }
        }
    </style>
</head>
<body>
        <?php @include "header.php";?>

    <div class="results-container">
        <div class="header">
            <span class="food-icon"></span>
            <h1 class="title">Hasil Nutrisi</h1>
            <p class="subtitle">ringkasan hasil kalkulasi kalori yang anda konsumsi</p>
        </div>

        <div class="progress-ring">
            <svg>
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#4facfe"/>
                        <stop offset="100%" style="stop-color:#00f2fe"/>
                    </linearGradient>
                </defs>
                <circle class="bg" cx="60" cy="60" r="50"></circle>
                <circle class="progress" cx="60" cy="60" r="50"></circle>
            </svg>
            <div class="progress-text">
                <span class="progress-number" id="totalCaloriesDisplay"><?php echo $total_calories?></span>
                <span class="progress-label">calories</span>
            </div>
        </div>

        <div class="results-grid">
            <div class="result-item">
                <div class="result-label">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Nama makanan
                </div>
                <div class="result-value" id="foodName"><?php echo $food?></div>
            </div>

            <div class="result-item">
                <div class="result-label">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5 0 1.93-1.57 3.5-3.5 3.5s-3.5-1.57-3.5-3.5C8.5 7.57 10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/>
                    </svg>
                    Kalori per gram
                </div>
                <div class="result-value" id="caloriesPerGram"><?php echo $calories." kal"?></div>
            </div>

            <div class="result-item">
                <div class="result-label">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M7 4V2C7 1.45 7.45 1 8 1S9 1.45 9 2V4H15V2C15 1.45 15.45 1 16 1S17 1.45 17 2V4H20C21.1 4 22 4.9 22 6V20C22 21.1 21.1 22 20 22H4C2.9 22 2 21.1 2 20V6C2 4.9 2.9 4 4 4H7ZM4 8V20H20V8H4Z"/>
                    </svg>
                    Berat yang dikonsumsi
                </div>
                <div class="result-value" id="weight"><?php echo $berat ?></div>
            </div>

            <div class="result-item total-calories">
                <div class="result-label">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                    </svg>
                    Total energi
                </div>
                <div class="result-value" id="totalCalories"><?php echo $total_calories ?></div>
            </div>
        </div>

        <div class="actions">
            <button class="btn btn-secondary" onclick="goBack()">
                <svg class="icon" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                Calculate Again
            </button>
            <button class="btn btn-primary" onclick="shareResults()">
                <svg class="icon" viewBox="0 0 24 24" style="width: 18px; height: 18px;">
                    <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92-1.31-2.92-2.92-2.92z"/>
                </svg>
                Share Results
            </button>
        </div>
    </div>

    <script>

        // Update display with data
        document.getElementById('foodName').textContent = data.food;
        document.getElementById('caloriesPerGram').textContent = data.calories + ' cal';
        document.getElementById('weight').textContent = data.weight + ' g';
        document.getElementById('totalCalories').textContent = data.totalCalories + ' cal';
        document.getElementById('totalCaloriesDisplay').textContent = data.totalCalories;

        // Update food icon based on food type
        const foodIcons = {
            'Protein': '🍗',
            'Karbohidrat': '🍚',
            'default': '🍽️'
        };

        function getFoodIcon(foodName) {
            const name = foodName.toLowerCase();
            for (let key in foodIcons) {
                if (name.includes(key)) {
                    return foodIcons[key];
                }
            }
            return foodIcons.default;
        }

        document.querySelector('.food-icon').textContent = getFoodIcon(data.category);

        function goBack() {
            window.location.href= '';
        }

        function shareResults() {
            if (navigator.share) {
                navigator.share({
                    title: 'My Calorie Calculation',
                    text: `I consumed ${totalCalories} calories from ${weight}g of ${foodName}!`,
                    url: window.location.href
                });
            } else {
                // Fallback - copy to clipboard
                const text = `I consumed ${totalCalories} calories from ${weight}g of ${foodName}!`;
                navigator.clipboard.writeText(text).then(() => {
                    alert('Results copied to clipboard!');
                });
            }
        }
        document.querySelectorAll('.result-item').forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
            item.style.animation = 'slideUp 0.6s ease-out forwards';
        });
    </script>
</body>
</html>