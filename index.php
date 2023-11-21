<!-- главная страница -->
<?php
	session_start();
	include "connect.php";

	$role = (isset($_SESSION["role"])) ? $_SESSION["role"] : "guest";

	$sql = "SELECT * FROM `categories`";
	$result = $connect->query($sql);
	$categories = "";
	while($row = $result->fetch_assoc())
		$categories .= sprintf('<option value="%s">%s</option>', $row["category"], $row["category"]);

	$sql = "SELECT * FROM `products` WHERE `count` > 0 ORDER BY `created_at` DESC";
	if(!$result = $connect->query($sql))
		return die ("Ошибка получения данных: ". $connect->error);

	$data = "";
	while($row = $result->fetch_assoc())
		$data .= sprintf('
			<div class="col">
				<img src="%s" alt="">
				<div class="row" style=" display: flex;
				flex-direction:column;">
					<h3><a href="product.php?id=%s">%s</a></h3>
					<input type="hidden" value="%s" name="product_id">
					<input type="hidden" value="%s" name="year">
					<input type="hidden" value="%s" name="category">
				</div>
				%s
				%s
			</div>
		', $row["image"], $row["product_id"], $row["name"], $row["product_id"], $row["year"], $row["category"],
		($role == "admin") ? '
			<div class="row">
				<p><a href="update.php?id='.$row["product_id"].'" class="text-small">Редактировать</a></p>
				<p><a onclick="return confirm(\'Вы действительно хотите удалить этот товар?\')" href="asset/controllers/delete_product.php?id='.$row["product_id"].'" class="text-small">Удалить</a></p>
			</div>
		' : '',
		($role != "guest") ? '<a href="asset/controllers/add_cart.php?id='. $row["product_id"] .'" >В избранное</a></button>' : '');

	if($data == "")
		$data = '<h3 class="text-center">Товары отсутствуют</h3>';

	include "header.php";
?>

 <div class="content">

 <!-- баннер -->
 <div class="page">
 <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="myimg">
          <img src="asset/img/1.jpg" alt="" style="width:100%"></div>
        </div>
      
        <div class="mySlides fade">
            <div class="myimg">
          <img src="asset/img/2.jpg" alt="" style="width:100%"></div>
        </div>
      
        <div class="mySlides fade">
            <div class="myimg">
          <img src="asset/img/3.jpg" alt="" style="width:100%"></div>
        </div>
      </div>  </div>
      <br>
		
	</header>

<!--
			<div class="head" id="register">Регистрация</div>
			<form action="controllers/register.php" method="POST">
				<input type="text" placeholder="Имя" name="name" pattern="[а-яА-ЯёЁ\s\-]+" required>
				<input type="text" placeholder="Фамилия" name="surname" pattern="[а-яА-ЯёЁ\s\-]+" required>
				<input type="text" placeholder="Отчество" name="patronymic" pattern="[а-яА-ЯёЁ\s\-]+">
				<input type="text" placeholder="Логин" name="login" pattern="[a-zA-Z0-9\-]+" required>
				<input type="email" placeholder="Email" name="email" required>
				<input type="password" placeholder="Пароль" name="password" pattern=".{6,}" required>
				<input type="password" placeholder="Повтор пароля" name="password_repeat" required>
				<div class="part">
					<input type="checkbox" name="rules" required>
					<p>Согласие с правилами регистрации</p>
				</div>
				<button>Зарегистрироваться</button>
			</form>

			<div class="head" id="login">Вход</div>
			<form action="controllers/login.php" method="POST">
				<input type="text" placeholder="Логин" name="login" required>
				<input type="password" placeholder="Пароль" name="password" required>
				<button>Войти</button>
			</form>
-->

<div class="row" style="margin: 20px; display: flex;
justify-content: flex-start;">
			<select id="category" onchange="filter.filter('category', 'filter')">
					<option value disabled selected >Фильтр</option>
					<?= $categories ?>
				</select>
				
				
			</div>

			<div class="row" id="products">
				<?= $data ?>
			</div>

		</div>
		
	</main>

	<script>filter.products()</script>	


		
		<?php
		include "footer.php";
		?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="asset/js/app.js"></script>
