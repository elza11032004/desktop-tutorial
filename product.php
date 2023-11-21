<!-- о товаре -->
<?php
	session_start();
	include "connect.php";
	
	$role = (isset($_SESSION["role"])) ? $_SESSION["role"] : "guest";
	$id = (isset($_GET["id"])) ? $_GET["id"] : 0;

	$sql = "SELECT * FROM `products` WHERE `count` > 0 AND `product_id`=". $id;
	if(!$result = $connect->query($sql))
		return die ("Ошибка получения данных: ". $connect->error);

	if(!$product = $result->fetch_assoc())
		return header("Location:index.php?message=Товар отсутствует");

	include "header.php";
?>

	<main>
		<div class="content">
			
			
			<div class="product wrap">
				<div class="image">
					<img src="<?= $product["image"] ?>" alt="">
				</div>
				
				<div class="text">
					<div class="head"><?= $product["name"] ?></div>
					
					<p style="margin-bottom:5px">Описание: <b><?= $product["country"] ?></b></p>
					<p style="margin-bottom:5px">Оценка: <b><?= $product["year"] ?></b></p>
					<p style="margin-bottom:5px">Автор: <b><?= $product["author"] ?></b></p>
					<p style="margin-bottom:5px">Актер: <b><?= $product["actor"] ?></b></p>
					<p>Список похожих фильмов: <b><?= $product["films"] ?></b></p>
					<div class="image">
					<img src="<?= $product["images"] ?>" alt="">
				</div>
					</div>
					<div class="row">
						
					<br>
					<?php
						if($role == "admin")
							echo '
								<div class="row">
									<p><a href="update.php?id='.$product["product_id"].'" class="text-small">Редактировать</a></p>
									<p><a onclick="return confirm(\'Вы действительно хотите удалить этот товар?\')" href="asset/controllers/delete_product.php?id='.$product["product_id"].'" class="text-small">Удалить</a></p>
								</div>
							';

						if($role != "guest")
							echo '<p class="text-right"><a href="asset/controllers/add_cart.php?id='. $product["product_id"] .'" class="text-small">В избранное</a></p>';
					?></div>
				</div>
			</div>

		</div>
		<?php
		include "footer.php";
		?>
	</main>

