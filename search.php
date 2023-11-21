<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kino";
$conn = new mysqli($servername, $username, $password, $dbname);

include "header.php";
// Получение списка товаров из базы данных
if ($_SERVER["REQUEST_METHOD"] == "GET") {
 $search_query = $_GET["q"];
 $sql = "SELECT * FROM products WHERE name LIKE 
'%$search_query%'";
 $result = $conn->query($sql);
}
?>

 <?php while ($row = $result->fetch_assoc()) { ?>
<section class="search">
 <img src="<?php echo $row["image"]?>"> 
 <div class="search__text">
 <p><?php echo $row["model"]; ?>: <?php echo $row["name"]; ?></p>
    <p></p>
    
 <p>Описание: <?php echo $row["country"]; ?></p>

 <p>Оценка: <?php echo $row["year"]; ?></p>
</div>
</section>
 <?php
 }?>