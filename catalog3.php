<!-- страница с тарифами -->
<?php
	session_start();
	include "connect.php";

	$role = (isset($_SESSION["role"])) ? $_SESSION["role"] : "guest";



	$sql = "SELECT * FROM `products2` WHERE `count` > 0 ORDER BY `created_at` DESC";
	if(!$result = $connect->query($sql))
		return die ("Ошибка получения данных: ". $connect->error);

	$data = "";
	while($row = $result->fetch_assoc())
		$data .= sprintf('
			<div class="col">
			<br><br><br><br>
				<div class="row" style=" display: flex;
				flex-direction:column;" >
					<h3 ><a href="product.php?id=%s" style="color: #CD3838;" >%s</a></h3>
					<input type="hidden" value="%s" name="product_id" >
<p style="text-align: justify; ">%s</p>
<p 

>%s</p>
				</div>
				<p style="margin-top: 40px; ">%s</p>
				<p>%s</p>
				
			</div>
		', $row["product_id"], $row["name"], $row["product_id"], $row["text"], $row["price"],
		($role == "admin") ? '
			
		' : '',
		($role != "guest") ? '<a href="asset/controllers/add_cart2.php?id='. $row["product_id"] .'" >Оформить</a></button>' : '');

	if($data == "")
		$data = '<h3 class="text-center">Товары отсутствуют</h3>';

	include "header.php";
?>

	<main>
		<div class="content">
				
			</div>

			<div class="row" id="products">
				<?= $data ?>
			</div>

		</div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<?php
		include "footer.php";
		?>
	</main>

	<script>filter.products()</script>

