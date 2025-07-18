<?php require_once 'app/views/templates/headerPublic.php'?>

<div class="hero-section py-5" style="background: linear-gradient(135deg, #e0f2fe 0%, #38bdf8 100%) !important; min-height: 60vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-3 fw-bold mb-4 text-dark">Never Forget Again</h1>
                <p class="lead mb-4 text-dark">ReminderApp helps you stay organized with simple, effective reminder management. Perfect for students and professionals alike.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="/create" class="btn btn-primary btn-lg">
                        <i class="bi bi-person-plus me-2"></i>Get Started Free
                    </a>
                    <a href="/features" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-star me-2"></i>View Features
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-journal-check" style="font-size: 12rem; opacity: 0.8; color: #2563eb;"></i>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold text-dark">Why Choose ReminderApp?</h2>
        <p class="lead text-muted">Simple, secure, and built for productivity</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4 text-center">
            <div class="card border-0 shadow-sm p-4 mb-3" style="background: #fff;">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%) !important; color: #2563eb;">
                    <i class="bi bi-lightning-charge" style="font-size: 2rem;"></i>
                </div>
                <h4 class="text-dark">Quick & Easy</h4>
                <p class="text-muted">Create reminders in seconds with our intuitive interface. No complexity, just results.</p>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card border-0 shadow-sm p-4 mb-3" style="background: #fff;">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%) !important; color: #22d3ee;">
                    <i class="bi bi-shield-check" style="font-size: 2rem;"></i>
                </div>
                <h4 class="text-dark">Secure</h4>
                <p class="text-muted">Your data is protected with modern security practices and user authentication.</p>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card border-0 shadow-sm p-4 mb-3" style="background: #fff;">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #e0f2fe 0%, #fef9c3 100%) !important; color: #f59e0b;">
                    <i class="bi bi-phone" style="font-size: 2rem;"></i>
                </div>
                <h4 class="text-dark">Mobile Ready</h4>
                <p class="text-muted">Access your reminders anywhere with our responsive, mobile-friendly design.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3 p-5 text-center" style="background: linear-gradient(135deg, #e0f2fe 0%, #fff 100%) !important;">
        <h3 class="mb-3 text-dark">Ready to Get Organized?</h3>
        <p class="lead mb-4 text-muted">Join students and professionals who trust ReminderApp to keep their lives on track.</p>
        <a href="/create" class="btn btn-primary btn-lg me-3">
            <i class="bi bi-rocket-takeoff me-2"></i>Start Now - It's Free!
        </a>
        <a href="/login" class="btn btn-outline-primary btn-lg">Already a member?</a>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php'?>