<?php require_once 'app/views/templates/headerPublic.php'?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="display-4">Contact Us</h1>
                <p class="lead text-muted">Questions about ReminderApp? We'd love to hear from you!</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-mortarboard text-primary" style="font-size: 3rem;"></i>
                            <h5 class="card-title mt-3">Academic Project</h5>
                            <p class="card-text text-muted">This is a student project for COSC 4806 Web Development course.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-github text-dark" style="font-size: 3rem;"></i>
                            <h5 class="card-title mt-3">Source Code</h5>
                            <p class="card-text text-muted">View the project repository and documentation on GitHub.</p>
                            <a href="https://github.com/JessicaCodesx/cosc-4806-3/tree/main" target="_blank" class="btn btn-outline-dark mt-3">
                                <i class="bi bi-github me-2"></i>View on GitHub
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-5">
                    <h3 class="mb-4 text-center">Project Information</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">Course Details</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Course:</strong> COSC 4806</li>
                                <li class="mb-2"><strong>Subject:</strong> Web Development</li>
                                <li class="mb-2"><strong>Term:</strong> Summer 2025</li>
                                <li class="mb-2"><strong>Version:</strong> <?= defined('VERSION') ? VERSION : '1.0.0' ?></li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <h5 class="mb-3">Technologies Used</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>PHP & SQL</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Bootstrap 5</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>MVC Architecture</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Session Management</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4 text-center">
                <div class="card-body p-4">
                    <h3 class="mb-3">🚀 Check out my GitHub!</h3>
                    <p class="text-muted">Explore more of my projects and contributions on GitHub.</p>
                    <a href="https://github.com/JessicaCodesx" target="_blank" class="btn btn-dark">
                        <i class="bi bi-github me-2"></i>Visit My GitHub Profile
                    </a>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="/create" class="btn btn-primary">Try ReminderApp</a>
                <a href="/about" class="btn btn-outline-primary ms-3">Learn More</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php'?>
