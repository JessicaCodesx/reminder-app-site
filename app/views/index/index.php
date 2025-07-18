<?php require_once 'app/views/templates/headerPublic.php'?>

<div class="bg-primary text-white" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-3 fw-bold mb-4">Never Forget Again</h1>
                <p class="lead mb-4">ReminderApp helps you stay organized with simple, effective reminder management. Perfect for students and professionals alike.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="/create" class="btn btn-light btn-lg">
                        <i class="bi bi-person-plus me-2"></i>Get Started Free
                    </a>
                    <a href="/features" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-star me-2"></i>View Features
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-journal-check" style="font-size: 12rem; opacity: 0.8;"></i>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Why Choose ReminderApp?</h2>
        <p class="lead text-muted">Simple, secure, and built for productivity</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4 text-center">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <i class="bi bi-lightning-charge text-primary" style="font-size: 2rem;"></i>
            </div>
            <h4>Quick & Easy</h4>
            <p class="text-muted">Create reminders in seconds with our intuitive interface. No complexity, just results.</p>
        </div>

        <div class="col-md-4 text-center">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <i class="bi bi-shield-check text-success" style="font-size: 2rem;"></i>
            </div>
            <h4>Secure</h4>
            <p class="text-muted">Your data is protected with modern security practices and user authentication.</p>
        </div>

        <div class="col-md-4 text-center">
            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                <i class="bi bi-phone text-warning" style="font-size: 2rem;"></i>
            </div>
            <h4>Mobile Ready</h4>
            <p class="text-muted">Access your reminders anywhere with our responsive, mobile-friendly design.</p>
        </div>
    </div>

    <div class="bg-light rounded-3 p-5 text-center">
        <h3 class="mb-3">Ready to Get Organized?</h3>
        <p class="lead mb-4">Join students and professionals who trust ReminderApp to keep their lives on track.</p>
        <a href="/create" class="btn btn-primary btn-lg me-3">
            <i class="bi bi-rocket-takeoff me-2"></i>Start Now - It's Free!
        </a>
        <a href="/login" class="btn btn-outline-primary btn-lg">Already a member?</a>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php'?>