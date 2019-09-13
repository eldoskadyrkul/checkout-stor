<?php 

session_start();

require_once('php/CreateDb.php');
require_once('php/component.php');

$database = new CreateDb("ProductDb", "products");

if (isset($_POST['remove'])) {
	if ($_GET['action'] == 'remove') {
		foreach ($_SESSION['cart'] as $key => $value) {
			if ($value['product_id'] == $_GET['id']) {
				unset($_SESSION['cart'][$key]);
				echo "<script>alert('Продукт успешно удален из корзины...!')</script>";
				echo "<script>window.location='cart.php'</script>";
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
	<title>Shop</title>

	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">

	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php require_once('php/header.php'); ?>
	<div class="container-fluid">
		<div class="row px-5">
			<div class="col-md-7">
				<div class="shopping-cart">
					<h6>Мои покупки</h6>
					<hr>
					<?php 
						$total = 0;
						if (isset($_SESSION['cart'])) {
							$product_id = array_column($_SESSION['cart'], 'product_id');

							$result = $database->getData();
							while ($row = mysqli_fetch_assoc($result)) {
								foreach ($product_id as $id) {
									if ($row['id'] == $id) {
										carts($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
										$total = $total + (int)$row['product_price'];
									}
								}								
							}
						} else {
							echo "Корзина пуста";
						}
					?>
				</div>
			</div>
			<div class="col-md-5">
				<div class="pt-4">
					<h6>Цена</h6>
					<hr>
					<div class="row price-details">
						<div class="col-md-6">
							<?php 
								if (isset($_SESSION['cart'])) {
									$count = count($_SESSION['cart']);
									echo "<h6>Цена: ($count покупок)</h6>";
								} else {
									echo "<h6>Цена: (0 покупок)</h6>";
								}
							?>
							<h6>Доставка</h6>
							<hr>
							<h6>Общая сумма</h6>
						</div>
						<div class="col-md-6">
							<h6><i class='fas fa-tenge'></i> <?php
								echo $total;								
							?></h6>
							<h6 class="text-success">БЕСПЛАТНО</h6>
							<hr>
							<h6><i class='fas fa-tenge'></i> <?php 
								echo $total;
							?></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>