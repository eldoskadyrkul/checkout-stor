<?php

function things($productname, $productprice, $productimg, $productid) {
	$oldprice = $productprice * 2;
	$element = "
		<div class='col-md-3 col-sm-6 my-3 my-md-0'>
			<form action='index.php' method='post'>
				<div class='card shadow' id='product_$productid'>
					<div>
						<img src='image/$productimg' alt='image' class='img-fluid card-img-top'>
					</div>
					<div class='card-body'>
						<h5 class='card-title'>$productname</h5>
						<h6>
							<i class='fa fa-star'></i>
							<i class='fa fa-star'></i>
							<i class='fa fa-star'></i>
							<i class='fa fa-star'></i>
							<i class='fa fa-star'></i>
						</h6>
						<p class='card-text'></p>
						<h5>
							<small><s class='text-secondary'>$oldprice <i class='fas fa-tenge'></i></s></small>
							<span class='price'>$productprice <i class='fas fa-tenge'></i></span>
						</h5>
						<button type='submit' name='addCart' class='btn btn-warning my-3' onclick='cart($productid)'>Добавить <i class='fas fa-shopping-cart'></i></button>
						<input type='hidden' value='$productid' name='product_id'>
						<input type='hidden' value='$productname' id='product_$productid'>
						<input type='hidden' value='$productprice' name='product_$productid'>						
					</div>
				</div>
			</form>
		</div>
	";
	echo $element;
}


function carts($productname, $productprice, $productimg, $productid)
{
	$oldprice = $productprice * 2;
	$element = "
		<form action='cart.php?action=remove&id=$productid' method='post' class='cart-items'>
			<div class='border rounded'>
				<div class='row bg-white'>
					<div class='col-md-3 pl-0'>
						<img src='image/$productimg' alt='Image1' class='img-fluid'>
					</div>
					<div class='col-md-6'>
						<h5 class='pt-2'>$productname</h5>
						<small class='text-secondary'>$oldprice <i class='fas fa-tenge'></i></small>
						<h5 class='pt-2'>$productprice  <i class='fas fa-tenge'></i></h5>
						<button type='submit' class='btn btn-danger' name='remove'>Удалить</button>
					</div>
				</div>
			</div>
		</form>";

	echo $element;
}
?>
