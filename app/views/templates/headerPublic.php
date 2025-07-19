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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS - Our unified design system -->
    <link rel="stylesheet" href="/app/styles/main.css">

    <link rel="icon" href="/favicon.png">
    <title>Reminder App - COSC 4806</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Additional styles for public pages -->
    <style>
        /* Public navbar specific styles */
        .navbar-public {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            border-bottom: 1px solid #2563eb;
        }

        .navbar-public .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.125rem;
        }

        .navbar-public .navbar-brand:hover {
            color: #bfdbfe !important;
        }

        .navbar-public .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem;
            margin: 0 2px;
        }

        .navbar-public .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-1px);
        }

        .navbar-public .btn-outline-primary {
            border-color: rgba(255, 255, 255, 0.5) !important;
            color: white !important;
            font-weight: 500;
        }

        .navbar-public .btn-outline-primary:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: white !important;
            color: white !important;
            transform: translateY(-1px);
        }

        .navbar-public .btn-primary {
            background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%) !important;
            border: none !important;
            color: white !important;
            font-weight: 600;
        }

        .navbar-public .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Mobile responsive */
        @media (max-width: 991px) {
            .navbar-public .navbar-nav {
                padding-top: 1rem;
            }

            .navbar-public .nav-link {
                margin: 2px 0;
            }

            .navbar-public .d-flex {
                margin-top: 1rem;
                gap: 0.5rem !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-public navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <i class="bi bi-journal-check me-2"></i>
                <span>ReminderApp</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: rgba(255, 255, 255, 0.3);">
                <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml;charset=utf8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 30 30%27%3e%3cpath stroke=%27rgba%28255, 255, 255, 0.85%29%27 stroke-linecap=%27round%27 stroke-miterlimit=%2710%27 stroke-width=%272%27 d=%27M4 7h22M4 15h22M4 23h22%27/%3e%3c/svg%3e');"></span>
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
                    <a class="btn btn-outline-primary" href="/login">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                    <a class="btn btn-primary" href="/create">
                        <i class="bi bi-person-plus me-1"></i>Sign Up
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main>