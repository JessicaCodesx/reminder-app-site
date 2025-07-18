<?php
// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check authentication - redirect if not logged in
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 1) {
    header('Location: /login');
    exit;
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

    <!-- Bootstrap CSS first -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom CSS last to override Bootstrap -->
    <link rel="stylesheet" href="/app/styles/main.css">

    <link rel="icon" href="/favicon.png">
    <title>Reminder App - COSC 4806</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="/home" style="color: white; font-weight: 700;">
                    <i class="bi bi-journal-check me-2"></i>
                    <span class="fw-bold">ReminderApp</span>
                </a>

                <!-- Mobile toggle button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Desktop navigation -->
                <div class="collapse navbar-collapse d-none d-lg-flex">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SESSION['controller'] ?? '') == 'home' ? 'active' : '' ?>" href="/home" style="color: rgba(255, 255, 255, 0.9);">
                                <i class="bi bi-house-door me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SESSION['controller'] ?? '') == 'reminders' ? 'active' : '' ?>" href="/reminders" style="color: rgba(255, 255, 255, 0.9);">
                                <i class="bi bi-list-task me-1"></i>My Reminders
                                <?php if ($pendingCount > 0): ?>
                                    <span class="badge bg-warning text-dark ms-1"><?= $pendingCount ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="quickActionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgba(255, 255, 255, 0.9);">
                                <i class="bi bi-plus-circle me-1"></i>Quick Actions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="quickActionsDropdown">
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
                            <a class="nav-link <?= ($_SESSION['controller'] ?? '') == 'reports' ? 'active' : '' ?>" href="/reports" style="color: rgba(255, 255, 255, 0.9);">
                                <i class="bi bi-bar-chart me-1"></i>Admin Reports
                                <span class="badge bg-warning text-dark ms-1">Admin</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-color: rgba(255, 255, 255, 0.5); color: white;">
                            <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
                            <?php if (isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
                                <span class="badge bg-warning text-dark ms-1">Admin</span>
                            <?php endif; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
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
                            <li><a class="dropdown-item" href="/reports" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e;">
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
        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarOffcanvas" aria-labelledby="navbarOffcanvasLabel" style="background: #1e293b;">
            <div class="offcanvas-header" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white;">
                <h5 class="offcanvas-title fw-bold" id="navbarOffcanvasLabel" style="color: white;">
                    <i class="bi bi-journal-check me-2"></i>ReminderApp
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body" style="padding: 1.5rem;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home" style="color: #cbd5e1; padding: 0.5rem 1rem; border-radius: 0.5rem; margin-bottom: 0.25rem;">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reminders" style="color: #cbd5e1; padding: 0.5rem 1rem; border-radius: 0.5rem; margin-bottom: 0.25rem;">
                            <i class="bi bi-list-task me-2"></i>My Reminders
                            <?php if ($pendingCount > 0): ?>
                                <span class="badge bg-warning text-dark ms-1"><?= $pendingCount ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reminders/create" style="color: #cbd5e1; padding: 0.5rem 1rem; border-radius: 0.5rem; margin-bottom: 0.25rem;">
                            <i class="bi bi-plus-circle me-2"></i>New Reminder
                        </a>
                    </li>

                    <?php if (isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
                    <li><hr class="my-2" style="border-color: #475569;"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports" style="color: #cbd5e1; padding: 0.5rem 1rem; border-radius: 0.5rem; margin-bottom: 0.25rem; background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e;">
                            <i class="bi bi-bar-chart me-2"></i>Admin Reports
                            <span class="badge bg-warning text-dark ms-1">Admin</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <li><hr class="my-2" style="border-color: #475569;"></li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/logout" style="color: #ef4444; padding: 0.5rem 1rem; border-radius: 0.5rem;">
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
            <div class="modal-content" style="border-radius: 0.75rem; border: none; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
                <div class="modal-header" style="background: linear-gradient(135deg, #f8fafc 0%, white 100%); border-bottom: 1px solid #e2e8f0; border-radius: 0.75rem 0.75rem 0 0;">
                    <h5 class="modal-title fw-bold" id="quickReminderModalLabel" style="color: #1e293b;">
                        <i class="bi bi-lightning me-2"></i>Quick Add Reminder
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="quickReminderForm" action="/reminders/store" method="post">
                    <div class="modal-body" style="padding: 2rem;">
                        <div class="mb-3">
                            <label for="quickTitle" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.875rem;">Title *</label>
                            <input type="text" class="form-control" id="quickTitle" name="title" required 
                                   placeholder="What do you need to remember?" style="border: 2px solid #e2e8f0; border-radius: 0.5rem; padding: 0.75rem 1rem;">
                        </div>
                        <div class="mb-3">
                            <label for="quickDueDate" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.875rem;">Due Date (optional)</label>
                            <input type="date" class="form-control" id="quickDueDate" name="due_date" style="border: 2px solid #e2e8f0; border-radius: 0.5rem; padding: 0.75rem 1rem;">
                        </div>
                        <div class="mb-3">
                            <label for="quickDescription" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.875rem;">Description (optional)</label>
                            <textarea class="form-control" id="quickDescription" name="description" rows="3" 
                                      placeholder="Add more details..." style="border: 2px solid #e2e8f0; border-radius: 0.5rem; padding: 0.75rem 1rem; resize: vertical; min-height: 100px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e2e8f0; padding: 1rem 2rem;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: linear-gradient(135deg, #64748b 0%, #475569 100%); border: none; border-radius: 0.5rem; padding: 0.75rem 1.5rem; font-weight: 600;">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); border: none; border-radius: 0.5rem; padding: 0.75rem 1.5rem; font-weight: 600;">
                            <i class="bi bi-check-lg me-1"></i>Add Reminder
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>