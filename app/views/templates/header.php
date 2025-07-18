<?php
if (!isset($_SESSION['auth'])) {
    header('Location: /login');
}

// Helper function to ensure user_id is available
function ensureUserId() {
    if (!isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        require_once 'app/models/User.php';
        $userModel = new User();
        $_SESSION['user_id'] = $userModel->getUserId($_SESSION['username']);
    }
    return $_SESSION['user_id'] ?? null;
}

// get the current user ID
$current_user_id = ensureUserId();

// get pending reminders count for current user
$pendingCount = 0;
if ($current_user_id) {
    require_once 'app/models/Reminder.php';
    $reminderModel = new Reminder();
    $pendingCount = $reminderModel->getPendingRemindersCount($current_user_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simple and efficient reminder management app">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="/favicon.png">
    <title>Reminder App - COSC 4806</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <style>
        :root {
            /* Modern Color Palette */
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #a5b4fc;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;

            /* Neutral Colors */
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;

            /* Spacing */
            --spacing-xs: 0.5rem;
            --spacing-sm: 0.75rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-2xl: 3rem;

            /* Typography */
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-size-xs: 0.75rem;
            --font-size-sm: 0.875rem;
            --font-size-base: 1rem;
            --font-size-lg: 1.125rem;
            --font-size-xl: 1.25rem;
            --font-size-2xl: 1.5rem;
            --font-size-3xl: 1.875rem;
            --font-size-4xl: 2.25rem;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--gray-50);
        }

        /* Navigation Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: var(--shadow-lg);
            padding: var(--spacing-sm) 0;
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: var(--font-size-xl);
            color: white !important;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: var(--spacing-xs) var(--spacing-md) !important;
            border-radius: var(--radius-md);
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .navbar-nav .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 2px;
            background: white;
            border-radius: 1px;
        }

        /* Dropdown Styles */
        .dropdown-menu {
            background: white;
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            padding: var(--spacing-sm);
            margin-top: var(--spacing-xs);
        }

        .dropdown-item {
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--gray-100);
            transform: translateX(2px);
        }

        .dropdown-item.admin-menu-item {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-left: 3px solid var(--warning-color);
        }

        .dropdown-item.admin-menu-item:hover {
            background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
        }

        /* Badge Styles */
        .badge {
            font-size: var(--font-size-xs);
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
        }

        .bg-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%) !important;
        }

        /* Button Styles */
        .btn {
            font-weight: 600;
            border-radius: var(--radius-md);
            padding: var(--spacing-sm) var(--spacing-lg);
            font-size: var(--font-size-sm);
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            background: transparent;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
            transform: translateY(-1px);
        }

        /* Offcanvas Styles */
        .offcanvas-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        }

        .offcanvas-body {
            background: white;
        }

        .offcanvas .nav-link {
            color: var(--gray-700) !important;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--radius-md);
            transition: all 0.3s ease;
        }

        .offcanvas .nav-link:hover {
            background-color: var(--gray-100);
            color: var(--primary-color) !important;
            transform: translateX(5px);
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-body {
            padding: var(--spacing-xl);
        }

        /* Form Styles */
        .form-control {
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            padding: var(--spacing-sm) var(--spacing-md);
            font-size: var(--font-size-sm);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: var(--spacing-xs);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: var(--font-size-lg);
            }

            .navbar-nav .nav-link {
                padding: var(--spacing-sm) !important;
            }
        }

        /* Loading Animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .loading .btn::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Smooth Animations */
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Improved Toast Positioning */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
        }

        /* Enhanced Search Bar (if needed) */
        .search-bar {
            position: relative;
            max-width: 300px;
        }

        .search-bar input {
            padding-left: 40px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-bar .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
    <header class="fade-in">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="/home">
                    <i class="bi bi-journal-check me-2"></i>
                    <span class="fw-bold">ReminderApp</span>
                </a>

                <!-- Offcanvas trigger for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Desktop navigation -->
                <div class="collapse navbar-collapse d-none d-lg-flex">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SESSION['controller'] ?? '') == 'home' ? 'active' : '' ?>" href="/home">
                                <i class="bi bi-house-door me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SESSION['controller'] ?? '') == 'reminders' ? 'active' : '' ?>" href="/reminders">
                                <i class="bi bi-list-task me-1"></i>My Reminders
                                <?php if ($pendingCount > 0): ?>
                                    <span class="badge bg-warning text-dark ms-1"><?= $pendingCount ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-plus-circle me-1"></i>Quick Actions
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/reminders/create">
                                    <i class="bi bi-plus me-2"></i>New Reminder
                                </a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#quickReminderModal">
                                    <i class="bi bi-lightning me-2"></i>Quick Add
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/reminders">
                                    <i class="bi bi-eye me-2"></i>View All
                                </a></li>
                            </ul>
                        </li>

                        <?php if (isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SESSION['controller'] ?? '') == 'reports' ? 'active' : '' ?>" href="/reports">
                                <i class="bi bi-bar-chart me-1"></i>Admin Reports
                                <span class="badge bg-warning text-dark ms-1">Admin</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
                            <?php if (isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
                                <span class="badge bg-warning text-dark ms-1">Admin</span>
                            <?php endif; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/home">
                                <i class="bi bi-house me-2"></i>Dashboard
                            </a></li>
                            <li><a class="dropdown-item" href="/reminders">
                                <i class="bi bi-list-task me-2"></i>My Reminders
                            </a></li>
                            <li><a class="dropdown-item" href="/reminders/create">
                                <i class="bi bi-plus-circle me-2"></i>New Reminder
                            </a></li>

                            <?php if (isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item admin-menu-item" href="/reports">
                                <i class="bi bi-bar-chart me-2"></i>Admin Reports
                            </a></li>
                            <?php endif; ?>

                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="/logout">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile Offcanvas -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarOffcanvas" aria-labelledby="navbarOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-bold" id="navbarOffcanvasLabel">
                    <i class="bi bi-journal-check me-2"></i>ReminderApp
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reminders">
                            <i class="bi bi-list-task me-2"></i>My Reminders
                            <?php if ($pendingCount > 0): ?>
                                <span class="badge bg-warning text-dark ms-1"><?= $pendingCount ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reminders/create">
                            <i class="bi bi-plus-circle me-2"></i>New Reminder
                        </a>
                    </li>

                    <?php if (isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
                    <li><hr class="my-2"></li>
                    <li class="nav-item">
                        <a class="nav-link admin-menu-item" href="/reports">
                            <i class="bi bi-bar-chart me-2"></i>Admin Reports
                            <span class="badge bg-warning text-dark ms-1">Admin</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <li><hr class="my-2"></li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/logout">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Quick Reminder Modal -->
    <div class="modal fade" id="quickReminderModal" tabindex="-1" aria-labelledby="quickReminderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="quickReminderModalLabel">
                        <i class="bi bi-lightning me-2"></i>Quick Add Reminder
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="quickReminderForm" action="/reminders/store" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="quickTitle" class="form-label">Title *</label>
                            <input type="text" class="form-control" id="quickTitle" name="title" required 
                                   placeholder="What do you need to remember?">
                        </div>
                        <div class="mb-3">
                            <label for="quickDueDate" class="form-label">Due Date (optional)</label>
                            <input type="date" class="form-control" id="quickDueDate" name="due_date">
                        </div>
                        <div class="mb-3">
                            <label for="quickDescription" class="form-label">Description (optional)</label>
                            <textarea class="form-control" id="quickDescription" name="description" rows="3" 
                                      placeholder="Add more details..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Add Reminder
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <main>