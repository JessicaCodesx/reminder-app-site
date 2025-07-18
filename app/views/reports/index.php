<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports - Reminder App</title>
    <link rel="stylesheet" href="/app/styles/reminders.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>📊 Admin Reports</h1>
                <p class="lead">System overview and analytics - <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>