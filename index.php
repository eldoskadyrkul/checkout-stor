<?php

// start session
session_start();
	
require_once('./php/CreateDb.php');
require_once('./php/component.php');

// create instance of createDb class
$database = new CreateDb("ProductDb", "products");

if (isset($_POST['addCart'])) {
	if (isset($_SESSION['cart'])) {
		$item_array_id = array_column($_SESSION['cart'], "product_id");

		if (in_array($_POST['product_id'], $item_array_id)) {
			echo "<script>alert('Продукт добавлен в корзину...!')</script>";
			echo "<script>window.location = 'index.php'</script>";
		} else {
			$count = count($_SESSION['cart']);
			$item_array =array('product_id' => $_POST['product_id']);

			$_SESSION['cart'][$count] = $item_array;
		}
	} else {
		$item_array = array('product_id' => $_POST['product_id']);

		// Create new session variable
		$_SESSION['cart'][0] = $item_array;
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
	<?php require_once('./php/header.php') ?>
	<div class="container">
		<div class="row text-center py-5">
			<?php
			$result = $database->getData();

			while ($row = mysqli_fetch_assoc($result)) {
				things($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
			}
			?>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
	function cart(id) {
		var ele = document.getElementById(id);
		var img_src = ele.getElementByTagName('img')[0].src;
		var name = ele.getElementById(id + "_name").value;
		var price = ele.getElementById(id + "_price").value;

		$.ajax({
			type: 'post',
			url: 'index.php',
			data: {
				product_image: img_src,
				product_name: name,
				product_price: price
			},
			success: function response() {
				document.getElementById('total').value = response;
				$('.status').html('Добавлен в корзину').fadeIn('slow').delay(2000).fadeOut('slow'); 
			}
		})
	}
</script> 
</html>