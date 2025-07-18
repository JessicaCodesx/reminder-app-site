<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reminders</title>
</head>

<?php require_once 'app/views/templates/header.php' ?>
<div class="container fade-in">
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
            <div class="actions-row">
                <a href="/reminders/create" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add New Reminder
                </a>
                <a href="/home" class="btn btn-secondary">
                    <i class="bi bi-house me-1"></i>Back to Home
                </a>
            </div>

            <?php if (empty($data['reminders'])): ?>
                <div class="empty-state">
                    <i class="bi bi-journal-x" style="font-size: 4rem; color: var(--gray-400); margin-bottom: 1rem;"></i>
                    <p>No reminders yet. <a href="/reminders/create">Create your first reminder!</a></p>
                </div>
            <?php else: ?>
                <?php foreach ($data['reminders'] as $reminder): ?>
                    <div class="reminder-card <?= $reminder['completed'] ? 'completed' : '' ?> slide-up">
                        <div class="reminder-title <?= $reminder['completed'] ? 'completed' : '' ?>">
                            <?= htmlspecialchars($reminder['title']) ?>
                        </div>

                        <?php if (!empty($reminder['description'])): ?>
                            <div class="reminder-description">
                                <?= nl2br(htmlspecialchars($reminder['description'])) ?>
                            </div>
                        <?php endif; ?>

                        <div class="reminder-meta">
                            <i class="bi bi-calendar-plus me-1"></i>Created: <?= date('M j, Y g:i A', strtotime($reminder['created_at'])) ?>
                            <?php if ($reminder['due_date']): ?>
                                <i class="bi bi-calendar-event ms-2 me-1"></i>Due: <?= date('M j, Y', strtotime($reminder['due_date'])) ?>
                            <?php endif; ?>
                            <?php if ($reminder['completed']): ?>
                                <i class="bi bi-check-circle ms-2 me-1"></i><strong>Completed</strong>
                            <?php endif; ?>
                        </div>

                        <div class="reminder-actions">
                            <form method="post" action="/reminders/toggle/<?= $reminder['id'] ?>">
                                <button type="submit" class="btn <?= $reminder['completed'] ? 'btn-warning' : 'btn-success' ?>">
                                    <i class="bi bi-<?= $reminder['completed'] ? 'arrow-counterclockwise' : 'check-lg' ?> me-1"></i>
                                    <?= $reminder['completed'] ? 'Mark Incomplete' : 'Mark Complete' ?>
                                </button>
                            </form>

                            <a href="/reminders/edit/<?= $reminder['id'] ?>" class="btn btn-primary">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>

                            <form method="post" action="/reminders/delete/<?= $reminder['id'] ?>" 
                                  onsubmit="return confirm('Are you sure you want to delete this reminder?')">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>