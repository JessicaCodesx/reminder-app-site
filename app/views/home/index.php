<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/app/styles/home.css">
</head>

<?php require_once 'app/views/templates/header.php' ?>
<main class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Hey <?= $_SESSION['username'] ?? 'there' ?>!</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3>What would you like to do?</h3>
            <p><a href="/reminders" class="btn btn-primary">📝 My Reminders</a></p>
        </div>
    </div>
</main>
<?php require_once 'app/views/templates/footer.php' ?>
