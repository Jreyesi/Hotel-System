<?php
// Database connection
$host = 'localhost';
$dbname = 'hotel_management';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Router
$page = $_GET['page'] ?? 'home';

// Include appropriate page
switch ($page) {
    case 'rooms':
        include 'pages/rooms.php';
        break;
    case 'bookings':
        include 'pages/bookings.php';
        break;
    case 'guests':
        include 'pages/guests.php';
        break;
    default:
        include 'pages/home.php';
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
        }
        nav a {
            color: white;
            margin: 0 1rem;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Hotel Management System</h1>
        <nav>
            <a href="?page=home">Home</a>
            <a href="?page=rooms">Rooms</a>
            <a href="?page=bookings">Bookings</a>
            <a href="?page=guests">Guests</a>
        </nav>
    </header>
    <main>
        <!-- Content loaded here -->
    </main>
</body>
</html>