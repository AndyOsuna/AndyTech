<?php 
include_once 'includes/header.php'; 
include_once 'db.php'; 

$productos = $mysql->query("SELECT * FROM `products`") or die("xd");

?>

<div class="container">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <p class="card-title h3 m-0">Productos</p>
        </div>
        <div class="card-body">
          <div class="row">

            <?php while($producto = $productos->fetch_array()) { ?>
              <a href="" class="col-md-4 card product p-0">
                <div class="card-body">
                  <p class="card-title h4 text-center"><?= $producto['nameProd'] ?></p>
                  <p class="price">$<?= $producto['price'] ?></p>
                  <p class="descr"><?= $producto['descr'] ?></p>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Comprar</button>
                  <button class="btn btn-success">Carrito</button>
                </div>
              </a>
              <?php } ?>
            </div>
            
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once 'includes/footer.php'; ?>