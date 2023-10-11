<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #ffffff; /* Latar belakang putih */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-container {
            text-align: center;
        }

        .error-code {
            font-size: 120px;
            color: #e74c3c;
        }

        .error-message {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .back-button {
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="error-message">Oops! Halaman tidak ditemukan.</div>
		<button class="back-button">Bawa Saya Kembali!</button>
    </div>
	<script>
        document.querySelector('.back-button').addEventListener('click', function() {
            window.history.back();
        });
    </script>
</body>
</html>
