</main>

    <footer class="bg-dark text-light mt-5 py-4" style="background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">📝 ReminderApp</h5>
                    <p class="text-muted small">
                        Simple and efficient reminder management for students and professionals.
                        Never forget important tasks again.
                    </p>
                </div>

                <div class="col-md-2 mb-3">
                    <h6 class="fw-semibold">Quick Links</h6>
                    <ul class="nav flex-column">
                        <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1): ?>
                            <li class="nav-item mb-1">
                                <a href="/home" class="nav-link p-0 text-muted small">Dashboard</a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="/reminders" class="nav-link p-0 text-muted small">My Reminders</a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="/reminders/create" class="nav-link p-0 text-muted small">Add Reminder</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item mb-1">
                                <a href="/" class="nav-link p-0 text-muted small">Home</a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="/login" class="nav-link p-0 text-muted small">Login</a>
                            </li>
                            <li class="nav-item mb-1">
                                <a href="/create" class="nav-link p-0 text-muted small">Sign Up</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>


                <div class="col-md-2 mb-3">
                    <h6 class="fw-semibold">Academic</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-1">
                            <span class="text-muted small">COSC 4806 Project</span>
                        </li>
                        <li class="nav-item mb-1">
                            <span class="text-muted small">Summer 2025</span>
                        </li>
                        <li class="nav-item mb-1">
                            <span class="text-muted small">Version <?= defined('VERSION') ? VERSION : '1.0' ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="text-muted small mb-0">
                        &copy; <?= date('Y') ?> ReminderApp. Made with ❤️ for COSC 4806. All rights reserved.
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="text-muted small">
                        Built with PHP & Bootstrap
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>