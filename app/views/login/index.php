<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sign In - Reminder App</title>
</head>
<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container fade-in">
		<div class="page-header" id="banner">
				<div class="row">
						<div class="col-lg-12">
								<h1>Welcome Back</h1>
								<p class="lead">Sign in to access your reminders</p>
						</div>
				</div>
		</div>

		<?php if (isset($_SESSION['lockout_error'])): ?>
				<div class="alert alert-danger">
						<strong>Account Locked!</strong> <?= htmlspecialchars($_SESSION['lockout_error']) ?>
				</div>
				<?php unset($_SESSION['lockout_error']); ?>
		<?php elseif (isset($_SESSION['login_error'])): ?>
				<div class="alert alert-warning">
						<?= htmlspecialchars($_SESSION['login_error']) ?>
				</div>
				<?php unset($_SESSION['login_error']); ?>
		<?php endif; ?>

		<div class="row">
				<div class="col-sm-auto">
						<form action="/login/verify" method="post" class="slide-up">
								<fieldset>
										<div class="form-group">
												<label for="username" class="form-label">Username</label>
												<input required type="text" class="form-control" name="username"
														<?= isset($_SESSION['lockout_time']) ? 'disabled' : '' ?>>
										</div>
										<div class="form-group">
												<label for="password" class="form-label">Password</label>
												<input required type="password" class="form-control" name="password"
														<?= isset($_SESSION['lockout_time']) ? 'disabled' : '' ?>>
										</div>
										<br>
										<button type="submit" class="btn btn-primary"
												<?= isset($_SESSION['lockout_time']) ? 'disabled' : '' ?>>
												<i class="bi bi-box-arrow-in-right me-1"></i>Login
										</button>	
								</fieldset>
						</form> 
				</div>
				<div class="row mt-3">
						<div class="col-lg-12">
								<p>Not signed up? <a href="/create">Sign up here</a></p>
						</div>
				</div>
		</div>

		<?php if (isset($_SESSION['lockout_time'])): ?>
				<!-- Countdown timer for lockout -->
				<script>
						// countdown timer for lockout
						let timeRemaining = <?= (int)$_SESSION['lockout_time']?>;

						function updateCountdown() {
								if (timeRemaining > 0) {
										// update alert msg with remaining time
										document.querySelector('.alert-danger').innerHTML = `<strong>Account Locked!</strong> Please wait ${timeRemaining} seconds before trying again.`;
										timeRemaining--; // dec time remaining
										setTimeout(updateCountdown, 1000); // call again after 1 second
								} else {
										// time expired: reload page to re enable the form and remove lockout msg
										location.reload();
								}
						}
						// if there's time left still start the countdown
						if (timeRemaining > 0) {
								updateCountdown();
						}
				</script>
				<?php unset($_SESSION['lockout_time']); ?>
		<?php endif; ?>
</main>

<?php require_once 'app/views/templates/footer.php' ?>