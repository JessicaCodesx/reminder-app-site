<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Sign Up Now</h1>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['signup_success'])): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_SESSION['signup_success']) ?>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['signup_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] > 0): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-warning" role="alert">
                    Invalid username or password. Attempts: <?= $_SESSION['failedAuth'] ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

<div class="row">
    <div class="col-sm-auto">
    <form action="/login/verify" method="post" >
    <fieldset>
      <div class="form-group">
        <label for="username">Username</label>
        <input required type="text" class="form-control" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input required type="password" class="form-control" name="password">
      </div>
            <br>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </fieldset>
    </form> 
  </div>
    <div class="row mt-3">
            <div class="col-lg-12">
                    <p>Already signed up? <a href="/login">Log in here</a></p>
            </div>
    </div>
</div>

    <?php require_once 'app/views/templates/footer.php' ?>