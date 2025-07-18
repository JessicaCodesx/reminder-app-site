<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Reminder App</title>
    <link rel="stylesheet" href="/app/styles/create.css">
</head>

<?php require_once 'app/views/templates/headerPublic.php'; ?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Sign Up Now</h1>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['signup_success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['signup_success']) ?></div>
        <?php unset($_SESSION['signup_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['signup_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['signup_error']) ?></div>
        <?php unset($_SESSION['signup_error']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-auto">
            <form action="/create/signup" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input required type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input required type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input required type="password" class="form-control" name="confirm_password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </fieldset>
            </form> 
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12">
            <p>Already signed up? <a href="/login">Log in here</a></p>
        </div>
    </div>
</main>
<?php require_once 'app/views/templates/footer.php'; ?>
