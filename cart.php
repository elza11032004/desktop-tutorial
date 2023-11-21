<!-- избранное -->
<?php
	include "asset/controllers/check.php";

	include "connect.php";

	$sql = sprintf("SELECT `order_id`, `product_id`, `orders`.`count`, `name`, `image` FROM `orders` INNER JOIN `products` USING(`product_id`) WHERE `user_id`='%s'", $_SESSION["user_id"]);
	$result = $connect->query($sql);

	$products = "";
	while($row = $result->fetch_assoc())
		$products .= sprintf('
			<div class="col">
				<img src="%s" alt="">
				<div class="row"  style=" display: flex;
				flex-direction:column;">
					<h3><a href="product.php?id=%s">%s</a></h3>
				</div>
				<div class="row">
					<p><a href="asset/controllers/delete_cart.php?id=%s">Удалить</a></p>
				</div>
			</div>
		', $row["image"], $row["product_id"], $row["name"], $row["product_id"], $row["count"], $row["product_id"]);

	if($products == "")
		$products = '<h3 class="text-center">Нет избранных</h3>';

	$sql = sprintf("SELECT * FROM `orders` WHERE `user_id`='%s' AND `number` IS NOT NULL AND `product_id`=0 ORDER BY `created_at` DESC", $_SESSION["user_id"]);
	$result = $connect->query($sql);

	$orders = "";
	while($row = $result->fetch_assoc()) {
		$del = ($row["status"] == "Новый") ? '<p class="text-right"><a onclick="return confirm(\'Вы действительно хотите удалить этот заказ?\')" href="asset/controllers/delete_order.php?id='.$row["order_id"].'" class="text-small">Отменить подписку</a></p>' : '';
		$orders .= sprintf('
			<div class="col">
				<div class="row">
					<h2> Вы подключили подписку </h2>
					%s
				</div>
				<div class="row">
					
				</div>
			</div>
		', $del, $row["status"], $row["count"]);
	}

	if($orders == "")
		$orders = '<h3 class="text-center">Нет активных подписок</h3>';

	include "header.php";
?>

		<div class="content">

			
			<div class="row">
				<?= $products ?>
			</div>
		

			<div class="row">
				<?= $orders ?>
			</div>

		</div>
		<?php
		include "footer.php";
		?>
	</main>

