<?php
include_once 'db.php';

$cats = $mysql->query("SELECT * FROM `cats`");

include_once './includes/header.php';
?>

<div class="container pt-3">
  <div class="row">
    <div class="col-md-6 mx-auto">

      <div class="card">
        <div class="card-header">
        <p class="h4 m-0 text-center">Añadir producto</p>
        </div>
        <div class="card-body">
          <?php if (isset($_SESSION['prodAdded'])) { ?>
            <div class="alert alert-success">
              <?= $_SESSION['prodAdded'] ?>
            </div>
          <?php
            unset($_SESSION['prodAdded']);
          }
          if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
          <?php
            unset($_SESSION['error']);
          }
          ?>

          <form action="./functions/add.php" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="name" placeholder="Nombre del producto" dautofocus required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="price" placeholder="Precio" required>
            </div>
            <div class="form-group">
              <small>Categoría</small>
              <select name="cat" class="form-control" placeholder="Categoría">
                <?php while ($cat = $cats->fetch_object()) { ?>

                  <option value="<?= $cat->name ?>"><?= $cat->name ?></option>

                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <textarea type="text" class="form-control" name="descr" placeholder="Descripción" required></textarea>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" name="urlImg" placeholder="Nombre de archivo de la imagen">
                <div class="input-group-append">
                  <div class="input-group-text">Opcional</div>
                </div>
              </div>
            </div>

            <button type="submit" name="submit-product" class="btn btn-primary btn-block">Guardar producto</button>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<?php
include './includes/footer.php';
?>