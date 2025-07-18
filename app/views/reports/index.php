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
                <h1> Admin Reports</h1>
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

   <!-- Users with Most Reminders Chart -->
    <div class="row" style="margin-bottom: 30px;">
        <div class="col-lg-12">
            <div class="reminder-card">
                <h3 style="margin-bottom: 20px;"> Users with Most Reminders</h3>
                <canvas id="remindersChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- login stats -->
    <div class="row" style="margin-bottom: 30px;">
        <div class="col-lg-12">
            <div class="reminder-card">
                <h3 style="margin-bottom: 20px;"> Login Statistics</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                <th style="padding: 12px; text-align: left; border-right: 1px solid #dee2e6;">Username</th>
                                <th style="padding: 12px; text-align: center; border-right: 1px solid #dee2e6;">Total Logins</th>
                                <th style="padding: 12px; text-align: center; border-right: 1px solid #dee2e6;">Failed Attempts</th>
                                <th style="padding: 12px; text-align: center;">Last Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['login_counts'] as $login): ?>
                            <tr style="border-bottom: 1px solid #dee2e6;">
                                <td style="padding: 12px; border-right: 1px solid #dee2e6; font-weight: 500;">
                                    <?= htmlspecialchars($login['username']) ?>
                                </td>
                                <td style="padding: 12px; text-align: center; border-right: 1px solid #dee2e6;">
                                    <span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px; font-size: 0.9em;">
                                        <?= $login['successful_logins'] ?>
                                    </span>
                                </td>
                                <td style="padding: 12px; text-align: center; border-right: 1px solid #dee2e6;">
                                    <span style="background: #f8d7da; color: #721c24; padding: 4px 8px; border-radius: 4px; font-size: 0.9em;">
                                        <?= $login['failed_attempts'] ?>
                                    </span>
                                </td>
                                <td style="padding: 12px; text-align: center; font-size: 0.9em; color: #666;">
                                    <?= $login['last_login'] ? date('M j, Y g:i A', strtotime($login['last_login'])) : 'Never' ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- all reminders -->
    <div class="row">
        <div class="col-lg-12">
            <div class="reminder-card">
                <h3 style="margin-bottom: 20px;"> All Reminders</h3>
                <div style="margin-bottom: 15px;">
                    <span style="background: #e8f5e8; padding: 6px 12px; border-radius: 4px; font-size: 0.9em; margin-right: 10px;">
                        Total: <?= count($data['all_reminders']) ?>
                    </span>
                </div>

                <?php if (empty($data['all_reminders'])): ?>
                    <p style="text-align: center; color: #666; font-style: italic;">No reminders found.</p>
                <?php else: ?>
                    <div style="max-height: 400px; overflow-y: auto;">
                        <?php foreach ($data['all_reminders'] as $reminder): ?>
                            <div style="border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; margin-bottom: 10px; background: <?= $reminder['completed'] ? '#f8fff9' : '#fff' ?>;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                    <h4 style="margin: 0; color: #2c3e50; <?= $reminder['completed'] ? 'text-decoration: line-through; opacity: 0.7;' : '' ?>">
                                        <?= htmlspecialchars($reminder['title']) ?>
                                    </h4>
                                    <div style="display: flex; gap: 8px; align-items: center;">
                                        <span style="background: #007bff; color: white; padding: 2px 6px; border-radius: 4px; font-size: 0.8em;">
                                            <?= htmlspecialchars($reminder['username']) ?>
                                        </span>
                                        <?php if ($reminder['completed']): ?>
                                            <span style="background: #28a745; color: white; padding: 2px 6px; border-radius: 4px; font-size: 0.8em;">
                                                ✓ Done
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if (!empty($reminder['description'])): ?>
                                    <p style="margin: 0 0 8px 0; color: #555; font-size: 0.9em;">
                                        <?= nl2br(htmlspecialchars($reminder['description'])) ?>
                                    </p>
                                <?php endif; ?>

                                <div style="font-size: 0.8em; color: #666;">
                                    Created: <?= date('M j, Y g:i A', strtotime($reminder['created_at'])) ?>
                                    <?php if ($reminder['due_date']): ?>
                                        | Due: <?= date('M j, Y', strtotime($reminder['due_date'])) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-lg-12">
            <div style="text-align: center;">
                <a href="/home" class="btn btn-secondary">← Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
