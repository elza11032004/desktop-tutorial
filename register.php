<!-- страница с регестрацией -->
<?php
	session_start();
	include "connect.php";

	$sql = "SELECT * FROM `products` WHERE `count` > 0 ORDER BY `created_at` DESC LIMIT 5";
	if(!$result = $connect->query($sql))
		return die ("Ошибка получения данных: ". $connect->error);

	$data = "";
	while($row = $result->fetch_assoc())
		$data .= sprintf('
			<div class="slide col">
				<img src="%s" alt="" />
				<h3><a href="product.php?id=%s">%s</a></h3>
			</div>
		', $row["image"], $row["product_id"], $row["name"]);

	if($data == "")
		$data = '<h3 class="text-center">Товары отсутствуют</h3>';

	include "header.php";
?>

	<main>
		
	<div class="forms">

			<div class="head" id="register">Регистрация</div>
			<form action="asset/controllers/register.php" method="POST">
				<input type="text" placeholder="Имя" name="name" pattern="[а-яА-ЯёЁ\s\-]+" required>
				<input type="text" placeholder="Фамилия" name="surname" pattern="[а-яА-ЯёЁ\s\-]+" required>
				<input type="text" placeholder="Отчество" name="patronymic" pattern="[а-яА-ЯёЁ\s\-]+">
				<input type="text" placeholder="Логин" name="login" pattern="[a-zA-Z0-9\-]+" required>
				<input type="email" placeholder="Email" name="email" required>
				<input type="password" placeholder="Пароль" name="password" pattern=".{6,}" required>
				<input type="password" placeholder="Повтор пароля" name="password_repeat" required>
				<div class="part">
					<input type="checkbox" name="rules" required >
					<p>Согласие с правилами регистрации</p>
				</div>
				<button >Зарегистрироваться</button>
			</form>

		</div>
		<?php
		include "footer.php";
		?>
	</main>

	<script src="scripts/slider.js"></script>

