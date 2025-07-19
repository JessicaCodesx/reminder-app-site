</main>

<!-- Full-width footer outside any container -->
<footer style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important; color: white; margin-top: auto; width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
            <!-- Brand Section -->
            <div>
                <h5 style="color: white; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center;">
                    <i class="bi bi-journal-check" style="margin-right: 0.5rem; font-size: 1.25rem;"></i>
                    ReminderApp
                </h5>
                <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.875rem; line-height: 1.6; margin: 0;">
                    Simple and efficient reminder management for students and professionals.
                    Never forget important tasks again with our intuitive platform.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h6 style="color: white; font-weight: 600; margin-bottom: 1rem;">Quick Links</h6>
                <nav style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1): ?>
                        <a href="/home" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 0.875rem; transition: color 0.3s ease; display: flex; align-items: center;">
                            <i class="bi bi-house-door" style="margin-right: 0.5rem; width: 1rem;"></i>Dashboard
                        </a>
                        <a href="/reminders" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 0.875rem; transition: color 0.3s ease; display: flex; align-items: center;">
                            <i class="bi bi-list-task" style="margin-right: 0.5rem; width: 1rem;"></i>My Reminders
                        </a>
                        <a href="/reminders/create" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 0.875rem; transition: color 0.3s ease; display: flex; align-items: center;">
                            <i class="bi bi-plus-circle" style="margin-right: 0.5rem; width: 1rem;"></i>Add Reminder
                        </a>
                    <?php else: ?>
                        <a href="/" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 0.875rem; transition: color 0.3s ease; display: flex; align-items: center;">
                            <i class="bi bi-house" style="margin-right: 0.5rem; width: 1rem;"></i>Home
                        </a>
                        <a href="/features" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 0.875rem; transition: color 0.3s ease; display: flex; align-items: center;">
                            <i class="bi bi-star" style="margin-right: 0.5rem; width: 1rem;"></i>Features
                        </a>
                        <a href="/login" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 0.875rem; transition: color 0.3s ease; display: flex; align-items: center;">
                            <i class="bi bi-box-arrow-in-right" style="margin-right: 0.5rem; width: 1rem;"></i>Login
                        </a>
                        <a href="/create" style="color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 0.875rem; transition: color 0.3s ease; display: flex; align-items: center;">
                            <i class="bi bi-person-plus" style="margin-right: 0.5rem; width: 1rem;"></i>Sign Up
                        </a>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Academic Info -->
            <div>
                <h6 style="color: white; font-weight: 600; margin-bottom: 1rem;">Academic Project</h6>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <div style="color: rgba(255, 255, 255, 0.8); font-size: 0.875rem; display: flex; align-items: center;">
                        <i class="bi bi-mortarboard" style="margin-right: 0.5rem; width: 1rem;"></i>
                        COSC 4806 - Web Development
                    </div>
                    <div style="color: rgba(255, 255, 255, 0.8); font-size: 0.875rem; display: flex; align-items: center;">
                        <i class="bi bi-calendar3" style="margin-right: 0.5rem; width: 1rem;"></i>
                        Summer 2025
                    </div>
                    <div style="color: rgba(255, 255, 255, 0.8); font-size: 0.875rem; display: flex; align-items: center;">
                        <i class="bi bi-code-square" style="margin-right: 0.5rem; width: 1rem;"></i>
                        Version <?= defined('VERSION') ? VERSION : '1.0.0' ?>
                    </div>
                </div>
            </div>

            <!-- Tech Stack -->
            <div>
                <h6 style="color: white; font-weight: 600; margin-bottom: 1rem;">Built With</h6>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <span style="background: rgba(255, 255, 255, 0.15); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 500;">PHP</span>
                    <span style="background: rgba(255, 255, 255, 0.15); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 500;">MySQL</span>
                    <span style="background: rgba(255, 255, 255, 0.15); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 500;">Bootstrap</span>
                    <span style="background: rgba(255, 255, 255, 0.15); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: 500;">MVC</span>
                </div>
                <div style="margin-top: 1rem;">
                    <a href="https://github.com/JessicaCodesx" target="_blank" style="color: white; text-decoration: none; font-size: 0.875rem; display: flex; align-items: center; transition: color 0.3s ease;">
                        <i class="bi bi-github" style="margin-right: 0.5rem; font-size: 1.25rem;"></i>
                        View on GitHub
                    </a>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <hr style="border: none; height: 1px; background: rgba(255, 255, 255, 0.2); margin: 2rem 0;">

        <!-- Bottom Section -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="color: rgba(255, 255, 255, 0.8); font-size: 0.875rem;">
                    &copy; <?= date('Y') ?> ReminderApp
                </div>
                <div style="color: rgba(255, 255, 255, 0.6); font-size: 0.875rem;">
                    Made with <span style="color: #ef4444;">❤️</span> for COSC 4806
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="color: rgba(255, 255, 255, 0.7); font-size: 0.875rem;">
                    <i class="bi bi-shield-check" style="margin-right: 0.25rem;"></i>
                    Secure & Reliable
                </div>
                <div style="color: rgba(255, 255, 255, 0.7); font-size: 0.875rem;">
                    <i class="bi bi-phone" style="margin-right: 0.25rem;"></i>
                    Mobile Ready
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Add hover effects for footer links -->
<style>
footer a:hover {
    color: white !important;
    text-decoration: underline !important;
}

footer .nav-link:hover,
footer a:hover {
    transform: translateX(2px);
}

/* Responsive footer adjustments */
@media (max-width: 768px) {
    footer > div {
        padding: 1.5rem 1rem !important;
    }

    footer > div > div:first-child {
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
    }

    footer > div > div:last-child {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 1rem !important;
    }

    footer > div > div:last-child > div:last-child {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>