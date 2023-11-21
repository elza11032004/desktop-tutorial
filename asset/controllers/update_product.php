<!-- изменение товара -->
<?php
	include "check_admin.php";
	include "../../connect.php";

	$connect->query(sprintf("UPDATE `products` SET `name`='%s', `country`='%s', `year`='%s', `model`='%s', `category`='%s', `count`='%s' WHERE `product_id`='%s'", $_POST["name"],  $_POST["country"], $_POST["year"], $_POST["model"], $_POST["category"], $_POST["count"], $_POST["id"]));

	return header("Location:../../product.php?id=".$_POST["id"]."&message=Товар изменён");
