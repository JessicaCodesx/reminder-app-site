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

<!-- Stats overview -->
<div class="row" style="margin-bottom: 30px;">
    <div class="col-lg-12">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div class="reminder-card" style="text-align: center; background: #e8f5e8;">
                <h3 style="color: #28a745; margin-bottom: 10px;"><?= $data['stats']['total_reminders'] ?></h3>
                <p style="margin: 0; color: #666;">Total Reminders</p>
            </div>
            <div class="reminder-card" style="text-align: center; background: #e8f4fd;">
                <h3 style="color: #007bff; margin-bottom: 10px;"><?= $data['stats']['total_users'] ?></h3>
                <p style="margin: 0; color: #666;">Total Users</p>
            </div>
            <div class="reminder-card" style="text-align: center; background: #fff3cd;">
                <h3 style="color: #856404; margin-bottom: 10px;"><?= $data['stats']['completed_reminders'] ?></h3>
                <p style="margin: 0; color: #666;">Completed</p>
            </div>
            <div class="reminder-card" style="text-align: center; background: #f8d7da;">
                <h3 style="color: #721c24; margin-bottom: 10px;"><?= $data['stats']['pending_reminders'] ?></h3>
                <p style="margin: 0; color: #666;">Pending</p>
            </div>
        </div>
    </div>
</div>