<?php
// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect authenticated users to home
if (isset($_SESSION['auth']) && $_SESSION['auth'] === 1) {
    header('Location: /home');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simple and efficient reminder management app">

    <!-- Primary Stylesheet - Main.css -->
    <link rel="stylesheet" href="/app/styles/main.css">

    <!-- Bootstrap for components only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" href="/favicon.png">
    <title>Reminder App - COSC 4806</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom shadow-sm" style="background: linear-gradient(135deg, #e0f2fe 0%, #2563eb 100%) !important;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/" style="color: #1e40af; font-weight: 700;">
                <i class="bi bi-journal-check me-2"></i>
                <span>ReminderApp</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="bi bi-house me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/features">
                            <i class="bi bi-star me-1"></i>Features
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">
                            <i class="bi bi-info-circle me-1"></i>About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">
                            <i class="bi bi-envelope me-1"></i>Contact
                        </a>
                    </li>
                </ul>

                <div class="d-flex gap-2">
                    <a class="btn btn-outline-primary" href="/login" style="border-color: #2563eb; color: #2563eb; background: #e0f2fe;">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                    <a class="btn btn-primary" href="/create" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important; color: #fff; border: none;">
                        <i class="bi bi-person-plus me-1"></i>Sign Up
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>