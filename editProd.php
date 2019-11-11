<?php

include_once 'db.php';

$cats = $mysql->query("SELECT * FROM `cats`");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$select = "SELECT * FROM products WHERE id = $id";
	$result = $mysql->query("SELECT * FROM products WHERE id = $id") or die($mysql->error);
	$product = $result->fetch_object();
}
include_once 'includes/header.php';

?>
<link rel="stylesheet" href="../css/bootstrap.min.css">

<div class="container pt-5">
	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Edit product</h3>
				</div>
				<div class="card-body">
					<!-- FORMULARIO -->
					<form action="functions/edit.php" method="post">
						<div class="form-group d-none">
							<input type="number" name="id" class="form-control" value="<?= $_GET['id'] ?>">
						</div>
						<div class="form-group">
							<input type="text" name="nomProd" placeholder="Product name" class="form-control" value="<?=$product->name?>" autofocus required>
						</div>
						<div class="form-group">
              <input type="number" class="form-control" name="price" placeholder="Price" value="<?=$product->price?>" required>
						</div>
						<div class="form-group">
              <select name="cat" class="form-control">
								<option value="<?=$product->cat?>"><?=$product->cat?></option>
								
								<?php while($cat = $cats->fetch_object()){ ?>
									
									<?php if($product->cat != $cat->name) { ?>
										<option value="<?= $cat->name ?>"><?= $cat->name ?></option>
									<?php } ?>

                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <textarea type="text" class="form-control" name="description" placeholder="Description" required><?= $product->descr ?></textarea>
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control" name="urlImg" placeholder="Nombre de archivo de la imagen" value="<?=$product->urlImg?>">
                <div class="input-group-append">
                  <div class="input-group-text">Opcional</div>
                </div>
              </div>
						</div>
						
            <button type="submit" class="btn btn-primary btn-block">Save product</button>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php';?>