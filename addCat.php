<?php
include_once './db.php';

if(isset($_POST['newCategory']))
{
  $newCat = $_POST['newCategory'];
  $mysql->query("INSERT INTO `cats` (`name`) VALUES ('$newCat')") or $_SESSION['error'] = "No se pudo guardar la nueva categoría. Hubo un error con la base de datos";
}

if(isset($_GET['delID']))
{
  $id = $_GET['delID'];
  $mysql->query("DELETE FROM `cats` WHERE `id` = $id");
  header("location: ". $_SERVER['PHP_SELF']);
}

$cats = $mysql->query("SELECT * FROM cats");

include_once './includes/header.php';

?>

<div class="container pt-3">
  <div class="row">
    <div class="col-md-6 my-0 mx-auto">
      <div class="card">
        <div class="card-header">
          <div class="card-title h4 text-center">Ingrese una nueva categoría</div>
        </div>
        <div class="card-body">
          <?php if(isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
              <?= $_SESSION['error'] ?>
            </div>
          <?php 
          unset($_SESSION['error']);
          } ?>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="newCategory" placeholder="Ingrese la caegoría" autofocus required>
            </div>
            <button class="btn btn-success btn-block" type="submit">Guardar</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Categoría</th>
            <th class="w-25">Funciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while($cat = $cats->fetch_object()) { ?>
          <tr>
            <td><?= $cat->name ?></td>
            <td><a href="<?= $_SERVER['PHP_SELF'].'?delID='.$cat->id ?>" class="btn btn-danger btn-block">Borrar</a></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<?php include_once './includes/footer.php'; ?>