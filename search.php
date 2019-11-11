<?php
include_once 'db.php';
if (isset($_GET['search'])) {
  $s = $_GET['search'];
  $p = $mysql->query("SELECT * FROM `products` WHERE name LIKE '$s'");
  while ($prod = $p->fetch_object()) { ?>

    <p><?= $prod->name ?></p>

<?php
  }
}
?>