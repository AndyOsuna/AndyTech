<?php
include_once './db.php';
include_once './includes/header.php';

if(isset($_POST['email'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $usuario = $mysql->query("SELECT * FROM users WHERE email = '$email'");
  $usuario = $usuario->fetch_array();

  if($usuario['email'] == "") {
    $_SESSION['error'] = "Email no registrado";
  } else {
    $_SESSION['login'] = $usuario['email'];
    $_SESSION['username'] = $usuario['username'];
    header("location: index.php");
  }
}

?>

<div class="container h-100vh">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <?php if(isset($_SESSION['error'])) { ?>
          <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
      <?php session_unset();} ?>
      
      <div class="card mt-5">
        <div class="card-header">
          <h3 class="card-title text-center m-0">Login</h3>
        </div>
        <div class="card-body">
          <form action="login.php" method="post">
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <a href="register.php" class="small mt-2 d-block text-right">Register here</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once './includes/footer.php';
?>