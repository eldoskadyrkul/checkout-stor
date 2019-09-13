<?php

// start session
session_start();

require_once('./php/CreateDb.php');

// create instance of createDb class
$database = new CreateDb("ProductDb", "products");

if(isset($_POST['addProduct'])) {
	$result = $database->insertData('name_things', 'price_things', 'img_things');
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
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="card-box card">
					<div class="card-head">
						<header>Добавление товара</header>
					</div>
					<div class="card-body">
						<form class="form-horizontal" action="addProducts.php" method="POST" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group row">
									<label class="control-label col-md-3">Наименование товара
									<span class="required"> * </span>
									</label>
									<div class="col-md-5">
										<input type="text" name="name_things" class="form-control input-height" placeholder="Введите наименование товара" autocomplete="off">
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Цена товара
										<span class="required"> * </span>
									</label>
									<div class="col-md-5">
										<input type="text" name="price_things" class="form-control input-height" placeholder="Введите цену товара" autocomplete="off">
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Изображение товара
										<span class="required"> * </span>
									</label>
									<div class="col-md-5">
										<input type="file" name="img_things" class="default">
									</div>
								</div>
								<div class="row">
									<div class="offset-md-3 col-md-9">
										<button class="btn btn-info m-r-20" type="submit" name="addProduct">Добавить</button>
									</div>
								</div>
							</div>
						</form>
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