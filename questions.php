<?php
include_once 'db.php';
include_once 'includes/header.php';

if (!isset($_SESSION['login'])) $_SESSION['error'] = "Es necesario que primero te logees!";
else {
  if (isset($_POST['question'])) {
    $q = $_POST['question'];
    $username = $user->username;
    $email = $user->email;

    $mysql->query("INSERT INTO `questions` (`username`, `email`, `message`) VALUES ('$username', '$email', '$q');");
    if ($mysql->error) $_SESSION['error'] = "Error al intentar enviar el mensaje";
    else $_SESSION['success'] = "Mensaje enviado satisfactoriamente";
  }
}
?>

<div class="container py-5">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card">
        <div class="card-body">

          <?php if (isset($_SESSION['error'])) { ?>

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong><?= $_SESSION['error'] ?></strong>
            </div>

          <?php unset($_SESSION['error']);
          } ?>

          <h4 class="card-title">Preguntá lo que necesites</h4>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
              <textarea name="question" rows="5" class="form-control" placeholder="Mensaje"></textarea>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once 'includes/footer.php'; ?>