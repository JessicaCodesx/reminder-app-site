<?php require_once 'app/views/templates/headerPublic.php'?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center mb-5">
                <h1 class="display-4">Features</h1>
                <p class="lead text-muted">Everything you need to stay organized</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-plus-circle text-primary" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Easy Creation</h5>
                    <p class="card-text text-muted">Create reminders quickly with our simple, intuitive interface.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-check text-success" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Due Dates</h5>
                    <p class="card-text text-muted">Set optional due dates to keep track of important deadlines.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle text-warning" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Track Progress</h5>
                    <p class="card-text text-muted">Mark reminders as complete and track your productivity.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="/create" class="btn btn-primary btn-lg">Get Started Today</a>
        <a href="/login" class="btn btn-outline-secondary btn-lg ms-3">Already have an account?</a>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php'?>