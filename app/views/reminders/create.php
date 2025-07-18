<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Reminder</title>
</head>

<body>
<?php require_once 'app/views/templates/header.php' ?>
<main role="main" class="container fade-in">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Create New Reminder</h1>
                <p class="lead">Add a new task to stay organized</p>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['reminder_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['reminder_error']) ?></div>
        <?php unset($_SESSION['reminder_error']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-auto">
            <form action="/reminders/store" method="post" class="slide-up">
                <fieldset>
                    <div class="form-group">
                        <label for="title" class="form-label">Title *</label>
                        <input required type="text" class="form-control" name="title" maxlength="255" 
                               placeholder="What do you need to remember?">
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" 
                                  placeholder="Add more details about your reminder (optional)"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="due_date" class="form-label">Due Date (optional)</label>
                        <input type="date" class="form-control" name="due_date">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i>Create Reminder
                        </button>
                        <a href="/reminders" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Cancel
                        </a>
                    </div>
                </fieldset>
            </form> 
        </div>
    </div>
</main>
</body>    
<?php require_once 'app/views/templates/footer.php'; ?>