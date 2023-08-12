<?php
session_start();
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sign-up form example">
    <meta name="author" content="Yazan">
    <title>Sign-up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
    <!-- here where the assets folder and where the bootstrap sheet -->
    <!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom Style  -->
    <link rel="stylesheet" href="assets/style.css">
  </head>

  <body>
  <div class="container mt-4">
        <?php if (isset($_SESSION['signup_success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['signup_success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['signup_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['signup_errors']) && !empty($_SESSION['signup_errors'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach ($_SESSION['signup_errors'] as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['signup_errors']); ?>
        <?php endif; ?>
    </div>


    <main class="form-signin w-100 m-auto">
      <form action="sign-up.php" method="post" id="signup-form">
        
        <h1 class="h3 mb-3 fw-normal">Please sign up</h1>

        <div class="form-floating">
          <input type="name" id="name" name="name" class="form-control" required>
          <label for="name">Name</label>
        </div>


        <div class="form-floating">
          <input type="email" id="email" name="email" class="form-control" required>
          <label for="email">Email</label>
        </div>


        <div class="form-floating">
          <input type="password" id="password" name="password" class="form-control" required>
          <label for="password">Password</label>
        </div>

        <div class="form-floating">
          <input type="password" id="password-confirmation" name="password_confirmation" class="form-control" required>
          <label for="password-confirmation">Password Confirmation</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
      </form>
    </main>
  </body>
</html>
