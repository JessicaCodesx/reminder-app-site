<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reminders</title>
    <link rel="stylesheet" href="/app/styles/home.css">
    <style>
        .reminder-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .reminder-card.completed {
            background: #d4edda;
            border-color: #c3e6cb;
        }
        .reminder-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .reminder-title.completed {
            text-decoration: line-through;
            color: #6c757d;
        }
        .reminder-meta {
            font-size: 0.9em;
            color: #6c757d;
            margin-bottom: 10px;
        }
        .reminder-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9em;
        }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>

<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>My Reminders</h1>
                <p class="lead"><?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['reminder_success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['reminder_success']) ?></div>
        <?php unset($_SESSION['reminder_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['reminder_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['reminder_error']) ?></div>
        <?php unset($_SESSION['reminder_error']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-12">
            <div style="margin-bottom: 20px;">
                <a href="/reminders/create" class="btn btn-primary">+ Add New Reminder</a>
                <a href="/home" class="btn btn-secondary">← Back to Home</a>
            </div>

            <?php if (empty($data['reminders'])): ?>
                <div class="reminder-card">
                    <p>No reminders yet. <a href="/reminders/create">Create your first reminder!</a></p>
                </div>
            <?php else: ?>
                <?php foreach ($data['reminders'] as $reminder): ?>
                    <div class="reminder-card <?= $reminder['completed'] ? 'completed' : '' ?>">
                        <div class="reminder-title <?= $reminder['completed'] ? 'completed' : '' ?>">
                            <?= htmlspecialchars($reminder['title']) ?>
                        </div>

                        <?php if (!empty($reminder['description'])): ?>
                            <div class="reminder-description">
                                <?= nl2br(htmlspecialchars($reminder['description'])) ?>
                            </div>
                        <?php endif; ?>

                        <div class="reminder-meta">
                            Created: <?= date('M j, Y g:i A', strtotime($reminder['created_at'])) ?>
                            <?php if ($reminder['due_date']): ?>
                                | Due: <?= date('M j, Y', strtotime($reminder['due_date'])) ?>
                            <?php endif; ?>
                            <?php if ($reminder['completed']): ?>
                                | <strong>Completed</strong>
                            <?php endif; ?>
                        </div>

                        <div class="reminder-actions">
                            <form method="post" action="/reminders/toggle/<?= $reminder['id'] ?>" style="display: inline;">
                                <button type="submit" class="btn <?= $reminder['completed'] ? 'btn-warning' : 'btn-success' ?>">
                                    <?= $reminder['completed'] ? 'Mark Incomplete' : 'Mark Complete' ?>
                                </button>
                            </form>

                            <a href="/reminders/edit/<?= $reminder['id'] ?>" class="btn btn-primary">Edit</a>

                            <form method="post" action="/reminders/delete/<?= $reminder['id'] ?>" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this reminder?')">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>