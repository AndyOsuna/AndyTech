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
/* Borrar item del carrito */
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
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-10 mx-auto">
      <table class="table table-carrito table-striped table-bordered">
        <thead>
          <tr>
            <?php if (!isset($cartEmpty)) { ?>
              <th>Name</th>
              <th style="max-width:50px;">Cantidad</th>
              <th>Price Unit.</th>
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
                <td><?= $prod->name ?></td>
                <!-- CANTIDAD -->
                <td>
                  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET" class="d-flex flex-row">
                    <input type="text" name="id" value="<?= $i ?>" class="d-none" readonly>
                    <input type="number" name="cantProd" class="form-control mr-auto" style="max-width: 65px;" value="<?= $cart[$i]["cant"] ?>">
                    <input type="submit" value="Update" class="btn btn-primary btn-sm">
                  </form>
                </td>
                <!-- PRECIO -->
                <td class="d-flex justify-content-between">
                  <p class="mr-2">$<?= $prod->price ?></p>
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
            <?php } else { ?>
              <td></td>
            <?php } ?>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

</div>