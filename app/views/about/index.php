<?php require_once 'app/views/templates/headerPublic.php'?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="display-4">About ReminderApp</h1>
                <p class="lead text-muted">A simple solution for staying organized</p>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h3 class="mb-4">Project Overview</h3>
                    <p class="mb-4">ReminderApp is a web-based reminder management system built as part of the COSC 4806 course project. It demonstrates modern web development practices using PHP, database, and Bootstrap.</p>

                    <h4 class="mb-3">Key Technologies</h4>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>PHP 8+ with MVC Architecture</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>SQL Database with PDO</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Bootstrap 5 for responsive design</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Session-based authentication</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Basic ACL (Access Control Lists)</li>
                    </ul>

                    <h4 class="mb-3">Course Information</h4>
                    <div class="bg-light p-3 rounded">
                        <p class="mb-1"><strong>Course:</strong> COSC 4806 - Web Development</p>
                        <p class="mb-1"><strong>Term:</strong> Summer 2025</p>
                        <p class="mb-0"><strong>Version:</strong> <?= defined('VERSION') ? VERSION : '1.0.0' ?></p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="/create" class="btn btn-primary">Try ReminderApp</a>
                <a href="/features" class="btn btn-outline-primary ms-3">View Features</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php'?>