<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reminder</title>
    <link rel="stylesheet" href="/app/styles/create.css">
</head>

<body>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Edit Reminder</h1>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['reminder_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['reminder_error']) ?></div>
        <?php unset($_SESSION['reminder_error']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-auto">
            <form action="/reminders/update/<?= $data['reminder']['id'] ?>" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <input required type="text" class="form-control" name="title" maxlength="255" 
                               value="<?= htmlspecialchars($data['reminder']['title']) ?>"
                               placeholder="Enter reminder title">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="4" 
                                  placeholder="Enter reminder description (optional)"><?= htmlspecialchars($data['reminder']['description']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date (optional)</label>
                        <input type="date" class="form-control" name="due_date" 
                               value="<?= $data['reminder']['due_date'] ? date('Y-m-d', strtotime($data['reminder']['due_date'])) : '' ?>">
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Update Reminder</button>
                    <a href="/reminders" class="btn btn-secondary">Cancel</a>
                </fieldset>
            </form> 
        </div>
    </div>
</main>
</body>    
<?php require_once 'app/views/templates/footer.php'; ?>