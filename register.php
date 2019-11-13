<?php
include_once './db.php';
include_once './includes/header.php';

if (isset($_POST['submit-register-user'])) {
  $username = $_POST['username'];
  $email    = $_POST['email'];
  $password = $_POST['password'];
  
  // Si cualquiera de los datos estan vacios
  if ($username == "" || $email == "" || $password == "") {
    $_SESSION['error'] = "Complete los campos!";
    // Si los todos los datos tienen datos
  } else {
    if ($_SESSION['captcha'] == $_POST['resultCaptcha']) {
      $password = hash("sha256", $password);

      $mysql->query("INSERT INTO users (username, email, pass) VALUES ('$username', '$email', '$password')") or die($mysql->error);

      $_SESSION['login'] = $email;
      $_SESSION['username'] = $username;
      header("location: index.php");
    } else {
      die("captcha erroneo");
    }
  }
}

?>

<div class="container h-100vh">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title text-center m-0">Register</h3>
        </div>
        <div class="card-body">
          <?php
          if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span></button>";
            echo "<strong>" . $_SESSION['error'] . "</strong></div>";
          }
          ?>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" autofocus required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <img src="functions/captcha.php" alt="captcha" class="captcha">
              <input type="text" class="form-control" name="resultCaptcha" placeholder="Ingrese el código" required>
            </div>
            <button type="submit" name="submit-register-user" class="btn btn-warning btn-block">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include_once './includes/footer.php';
?>