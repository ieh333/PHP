<!DOCTYPE html>
<!--
Начална страница на приложението за изчисление на рентите.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Web-базирана система за изчисление на рентите - "Рента"</title>
        <link rel="stylesheet" type="text/css" href="css/index.css" />
		<script type="text/javascript" src="js/jquery-validation-1.14.0/lib/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="js/slider.js"></script>
    </head>
    <body class="color">
	<header>
	<h1 class="text">Web-базирана система за рентни изчисления - "Рента"</h1>
	<div id="top_images">
	  <div>
	    <img src="images/top_img.jpg">
	  </div>
	  <div>
	    <img src="images/top_img2.jpg">
	  </div>
	  <div>
	    <img src="images/top_img3.jpg">
	  </div>
	  <div>
	    <img src="images/top_img4.jpg">
	  </div>
	  <div>
	    <img src="images/top_img5.jpg">
	  </div>
	</div>
	</header>
	<nav class="menu">
	<ul>
	<li><a href="index.php">Начало</a></li>
	<li><a href="theory/information.php">Информация</a></li>
	<li><a href="login.php">Вход/Регистрация</a></li>
	<li><a href="contacts.php">Контакти</a></li>
	</ul>
	</nav>
	<br />
	<aside id="vertical_menu">
	<ul>
	<li><a href="index.php">Начало</a></li>
	<li><a href="theory/information.php">Информация</a></li>
	<li><a href="login.php">Вход/Регистрация</a></li>
	<li><a href="contacts.php">Контакти</a></li>
	</ul>
	</aside>
	<section class="main">
	<article>
		<p>Разработваното приложение е Web-базирано, която се използва при изчисление на рентите. Това приложение се нарича "Рента".<br />
		То е направено с помощта на web технологията - <strong>PHP</strong>. За да съхрани данните - потребителите и изчислените ренти се използва известната Система за Управление на Релационна База Данни (СУРБД) - <strong>MySQL</strong>.
		Данните, които са свързани с теоретичната информация на различните видове Ренти се съхраняват един <strong>XML</strong> файл.
		В тази система е включена проверка на въведените потребителски данни - <i>Името, Фамилията, Потребителското име, Парола и Email-а</i> на съответния потребител.
		За по-голяма сигурност на въведените пароли, те се съхраняват в базата данни в криптиран вид.
		В приложението има страница, която показва <i>email-а, GSM номера</i> и <i>адреса</i> на разработчика - контакт с него.</p>
	</article>
	</section>
	<footer id="bottom_image">
	<img src="images/ru.png">Русенски университет "Ангел Кънчев"
	</footer>
    </body>
</html>
