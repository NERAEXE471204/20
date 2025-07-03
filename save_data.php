<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Избранное - Unisource</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .header p {
            font-size: 1.1rem;
            color: #666;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s ease;
        }

        .back-link:hover {
            opacity: 0.8;
        }

        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .university-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .university-card:hover {
            transform: translateY(-5px);
        }

        .university-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .university-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            margin-right: 1rem;
        }

        .university-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .university-location {
            color: #666;
            font-size: 0.9rem;
        }

        .remove-button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 15px;
            cursor: pointer;
            font-size: 0.8rem;
            margin-left: auto;
            transition: background 0.3s ease;
        }

        .remove-button:hover {
            background: #c82333;
        }

        .university-info p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .no-favorites {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 20px;
            margin-top: 2rem;
        }

        .no-favorites h2 {
            color: #333;
            margin-bottom: 1rem;
        }

        .no-favorites p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .cta-button {
            background: linear-gradient(45deg, #ff6b6b, #feca57);
            color: white;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        .clear-all {
            background: #6c757d;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease;
            margin-bottom: 2rem;
        }

        .clear-all:hover {
            background: #5a6268;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .favorites-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.html" class="back-link">← Назад на главную</a>
        
        <div class="header">
            <h1>Избранные университеты</h1>
            <p>Здесь сохранены университеты, которые тебе понравились</p>
        </div>

        <button class="clear-all" onclick="clearAllFavorites()" id="clearButton" style="display: none;">
            Очистить все
        </button>

        <div class="favorites-grid" id="favoritesGrid">
            <!-- Favorites will be populated by JavaScript -->
        </div>

        <div class="no-favorites" id="noFavorites">
            <h2>Пока нет избранных университетов</h2>
            <p>Добавь университеты в избранное, чтобы легко найти их позже. Начни с прохождения анкеты и выбора подходящих вариантов.</p>
            <a href="questionnaire.html" class="cta-button">Найти университеты</a>
        </div>
    </div>

    <script>
        // Load and display favorites
        function loadFavorites() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const grid = document.getElementById('favoritesGrid');
            const noFavorites = document.getElementById('noFavorites');
            const clearButton = document.getElementById('clearButton');
            
            if (favorites.length === 0) {
                grid.style.display = 'none';
                noFavorites.style.display = 'block';
                clearButton.style.display = 'none';
                return;
            }
            
            grid.style.display = 'grid';
            noFavorites.style.display = 'none';
            clearButton.style.display = 'block';
            
            grid.innerHTML = favorites.map(university => `
                <div class="university-card">
                    <div class="university-header">
                        <div class="university-logo">${university.logo}</div>
                        <div>
                            <div class="university-name">${university.name}</div>
                            <div class="university-location">${university.location}</div>
                        </div>
                        <button class="remove-button" onclick="removeFromFavorites(${university.id})">
                            Удалить
                        </button>
                    </div>
                    
                    <div class="university-info">
                        <p>${university.description}</p>
                        <p><strong>Стоимость:</strong> ${university.cost}</p>
                        <p><strong>Рейтинг:</strong> ${university.rating}/5</p>
                        <p><strong>Программы:</strong> ${university.programs.join(', ')}</p>
                    </div>
                </div>
            `).join('');
        }

        // Remove from favorites
        function removeFromFavorites(universityId) {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            favorites = favorites.filter(f => f.id !== universityId);
            localStorage.setItem('favorites', JSON.stringify(favorites));
            loadFavorites();
        }

        // Clear all favorites
        function clearAllFavorites() {
            if (confirm('Удалить все избранные университеты?')) {
                localStorage.removeItem('favorites');
                loadFavorites();
            }
        }

        // Initialize
        loadFavorites();
    </script>
</body>
</html>