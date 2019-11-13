<?php
include_once 'db.php';
include_once 'includes/header.php';

$cats = $mysql->query("SELECT * FROM `cats`");
if ($mysql->error) $_SESSION['error'] = "Error al intentar recuperar categorias de las Base de Datos";

if (isset($_GET['cat'])) {
  $cat = $_GET['cat'];

  $products = $mysql->query("SELECT * FROM `products` WHERE cat = '$cat'") or die("Fatal error");
  if ($mysql->error) $_SESSION['error'] = "Hubo un error<br>" . $mysql->error;
} else { }

?>

<div class="container-fluid pt-2">
  <div class="row">
    <div class="col-md-12">
      <p class="h1 text-center">Productos</p>
    </div>
    <div class="col-md-2 bg-primary text-white p-2">

      <p class="h4 text-center">Categorías</p>
      <a class="btn btn-primary py-1 btn-block" data-toggle="collapse" href="#categories">Ver</a>

      <div class="collapse" id="categories">
        <ul class="nav flex-column">
          <?php while ($cat = $cats->fetch_object()) { ?>
            <li class="nav-item">
              <a href="<?= $_SERVER['PHP_SELF'] ?>?cat=<?= $cat->name ?>" class="nav-link"><?= $cat->name ?></a>
            </li>
          <?php } ?>
        </ul>
      </div>

    </div>

    <div class="col-md-10">
      <div class="products">
        <?php if (!isset($_SESSION['error']) && isset($products)) {
          while ($reg = $products->fetch_object()) { ?>
            <div class="product">

              <h4 class="title text-center"><?= $reg->name ?></h4>
              <div class="h6 cat"><?= $reg->cat ?></div>
              <img class="imgProd" src="img/<?= $reg->urlImg ?>.jpg" alt="<?= $reg->name ?>">
              <p class="description my-1 small"><?= $reg->descr ?></p>
              <p class="price text-right font-italic">$<?= $reg->price ?></p>

              <div class="btn-functions">
                <?php if (isset($user) && $user->isAdmin) { ?>
                  <a href="editProd.php?id=<?= $reg->id ?>" class="btn btn-info">Editar</a>
                  <a href="functions/delete.php?id=<?= $reg->id ?>" class="btn btn-danger">Borrar</a>
                <?php } ?>
                <a href="functions/addCarrito.php?id=<?= $reg->id ?>" class="btn btn-dark">Agregar al carrito</a>
              </div>

            </div>

          <?php }
          } elseif (isset($_SESSION['error'])) { ?>
          <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong> <?= $_SESSION['error'] ?> </strong>
          </div>
        <?php unset($_SESSION['error']);
        } else { ?>
          <div class="alert alert-success text-center mx-auto" role="alert">
            <strong>Seleccione una categoría</strong>
          </div>
        <?php } ?>
      </div>
    </div>

  </div>
</div>

<?php
include_once 'includes/footer.php';
?>