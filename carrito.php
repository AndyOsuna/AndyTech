<?php
include_once 'db.php';
include_once 'includes/header.php';

$cart = $_SESSION['carrito'];
$result = "";
if ($cart != []) {
  for ($i = 0; $i < count($cart); $i++) {

    $result .= "id = " . $cart[$i]["id"];
    if ($i != count($cart) - 1) {
      $result .= " || ";
    }
  }
  $productos = $mysql->query("SELECT * FROM products WHERE " . $result)
    or die("no anda<br>" . $mysql->error);
} else {
  $cartEmpty = "Tu carrito está vacio";
}
function borrarDelCarrito($id, $cart)
{
  for ($i = 0; $i < count($cart); $i++) {
    if ($cart[$i]['id'] == $id) {

      array_splice($cart, $i, 1);
      $_SESSION['carrito'] = $cart;
      echo "BORRAR " . $id . '<br>' . $i . '<br>';
    }
  }
}
/* Vaciar todo el carrito */
if (isset($_GET['vaciar'])) {
  $vaciar = $_GET['vaciar'];

  if ($vaciar === "si") {
    $_SESSION['carrito'] = [];
    header("location: " . $_SERVER['PHP_SELF']);
  }
}

/* Borrar un item del carrito */
if (isset($_GET['deleteCartID'])) {
  $id = $_GET['deleteCartID'];
  borrarDelCarrito($id, $cart);

  for ($i = 0; $i < count($cart); $i++) {
    if ($cart[$i]['id'] == $id) {

      array_splice($cart, $i, 1);
      $_SESSION['carrito'] = $cart;
      echo "BORRAR " . $id . '<br>' . $i . '<br>';
    }
  }
  header("location: " . $_SERVER['PHP_SELF']);
}
/* Cambiar la cantidad de un producto en el carrito */
if (isset($_GET['id']) && isset($_GET['cantProd'])) {
  $id = $_GET['id'];
  $cant = $_GET['cantProd'];

  if ($cant > 0) {
    $cart[$id]['cant'] = $cant;
    $_SESSION['carrito'] = $cart;
  } else {
    borrarDelCarrito($id, $cart);
  }
}
/* COMPRA REALIZADA */
if (isset($_GET['comprado'])) {
  if (!isset($_SESSION['login'])) { ?>
    
    <div class="jumbotron bg-danger text-center text-white">
      <h1 class="display-3">No se pudo concretar la compra</h1>
      <p class="h3">Es necesario que esté logeado</p>
      <hr class="my-2">
      <p class="lead">
        <a class="btn btn-outline-light btn-lg" role="button" href="login.php">Logearse</a>
      </p>
    </div>

  <?php } else { ?>

    <div class="jumbotron bg-info text-center">
      <h1 class="display-1">Felicitaciones!</h1>
      <p class="h1">Compra realizada</p>
      <hr class="my-2">
      <p class="lead">
        <a class="btn btn-primary btn-lg" role="button" href="index.php">Seguir comprando</a>
      </p>
    </div>

  <?php }
  } else { ?>

  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <table class="table table-light table-striped table-carrito">
          <thead>
            <tr>
              <?php if (!isset($cartEmpty)) { ?>
                <th>Name</th>
                <th style="max-width:50px;">Cantidad</th>
                <th>Price Unit.</th>
                <th>Funciones</th>
              <?php } else { ?>
                <th colspan="3" class="h3 text-center"><?= $cartEmpty ?></th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php if (!isset($cartEmpty)) {
                $i = 0;
                $total = 0;
                while ($prod = $productos->fetch_object()) { ?>
                <tr>
                  <!-- NOMBRE -->
                  <td>
                    <img src="img/<?= $prod->urlImg ?>.jpg" alt="<?= $prod->name ?>" class="cart-img">
                    <span class="ml-4"><?= $prod->name ?></span>
                  </td>
                  <!-- CANTIDAD -->
                  <td>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" class="d-flex flex-row">
                      <input type="text" name="id" value="<?= $i ?>" class="d-none" readonly>
                      <input type="number" name="cantProd" class="form-control mr-auto" style="max-width: 65px;" value="<?= $cart[$i]["cant"] ?>">
                      <input type="submit" value="Update" class="btn btn-primary btn-sm">
                    </form>
                  </td>
                  <!-- PRECIO -->
                  <td class="">
                    <p class="mr-2">$<?= $prod->price ?></p>
                  </td>
                  <td>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?deleteCartID=<?= $prod->id ?>" class="btn btn-danger">Quitar</a>
                  </td>
                </tr>
            <?php
                  $total += ($prod->price * $cart[$i]["cant"]);
                  $i++;
                }
              } ?>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <?php if (!isset($cartEmpty)) { ?>
                <td>Total: $<?= $total ?></td>
                <td><a href="<?= $_SERVER['PHP_SELF'] ?>?vaciar=si" class="btn btn-success">Vaciar carrito</a></td>
              <?php } else { ?>
                <td></td>
                <td></td>
              <?php } ?>
            </tr>
          </tfoot>
        </table>
        <?php if (!isset($cartEmpty)) { ?>
          <a href="<?= $_SERVER['PHP_SELF'] ?>?comprado=1" class="btn btn-warning btn-lg ml-auto">Finalizar compra</a>
        <?php } ?>
      </div>
    </div>

  </div>
<?php }
include_once 'includes/footer.php';
?>