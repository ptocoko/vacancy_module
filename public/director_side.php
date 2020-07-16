<?php
//if ($_SESSION['work'] != 2 || $_SESSION['work'] != 6) {
//	header('Location: teacher_side.php');
//}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Реестр</title><!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE = edge"><![endif]-->
	<meta content="width=device-width, initial-scale=1, user-scalable=0" name="viewport">
	<link href="img/favicon.ico" rel="icon">
	<link href="css/main.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/vakansiya.css" rel="stylesheet">
	<link href="css/ion.rangeSlider.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/mystyles.css">

	<script src="../js/log_in.js" type="application/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
			integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			crossorigin="anonymous"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js" type="application/javascript"></script>
	<script src="js/ion.rangeSlider.min.js"></script>
	<script src="js/director/DirectorVacancy.js"></script>
	<script src="js/director/Responder.js"></script>
	<script src="https://use.fontawesome.com/c7b4c80e2e.js"></script>
</head>
<body>
<div class="wrapper">
	<header class="header">
		<div class="container">
			<div class="header__content"><a class="logo" href="index.php">Реестр резерва педагогических кадров Чеченской
					Республики</a>
				<div class="header__nav">
					<div class="header__nav-bg js-nav-toggle"></div>
					<div class="header__nav-content">
						<div class="header__nav-close js-nav-toggle"></div>
						<div class="singin-box"><a href="index.php"><i
									class="icon icon-user "></i>
							</a><span></span><a href="#" id="logout"><i class="icon icon-logout "></i></a>
						</div>
						<div class="nav">
							<ul>
								<li><a href="../index.php">Главная</a>
								</li>
								<li><a href="../docs.php">Документы</a>
								</li>
								<li><a href="../rating.php">Рейтинг учителей</a>
								</li>
								<li><a href="base.php">База учителей</a>
								</li>
								<li class="droped"><a href="#">Впервые на сайте?</a>
									<ul>
										<li><a href="../text.php">Для учителей</a></li>
										<li><a href="#">Регистрация</a></li>
										<li><a href="#">Для директоров</a></li>
									</ul>
								</li>
								<li><a href="../contacts.php">Контакты</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="burger"><a class="js-nav-toggle" href="#"><span></span></a></div>
			</div>
		</div>
	</header>
	<main class="content">
		<div class="breadcrumbs">
			<div class="container">
				<ul>
					<li><a href="index.php"><i class="icon icon-home "></i>Главная</a></li>
					<li><span>Банк вакансий</span>
					</li>
				</ul>
			</div>
		</div>
		<div class="inner">
			<div class="container">
				<h2>Банк вакансий</h2>
				<div class="base">
					<form class="form" style="margin-bottom: 0;">
						<div class="base-box">
							<div class="base-action">
								<button id="new_vacancy" style="border: 1px solid #12286f;">Создать вакансию</button>
								<div class="mx-2 w-full">
									На ваши вакансии отозвались <span id='vacancy_count'
																	  style="margin:0px;">0</b></span>
								</div>
							</div>
						</div>
						<div class="base-box px-0 py-0">
							<div class="modal-overlay " id="new_vacancy_fon" style="z-index:20;">
								<div class="modal " id="new_vacancy_modal">

								</div>
							</div>
						</div>
					</form>
					<!----Результат(блоки с учителями)--------------->
					<div class="rating-box mx-1 mt-1" id="schools_vacancies">
					</div>
					<!----Результат(блоки с учителями)--------------->
					<div class="base-action" style="display: none;">
						<button><i class="icon icon-refresh "></i>Показать еще учителей</button>
					</div>
				</div>
			</div>
		</div>

	</main>
	<footer class="footer">
		<div class="container">
			<div class="footer__content"><a class="logo" href="index.php">Реестр резерва педагогических кадров Чеченской
					Республики</a>
				<div class="footer__copy">© 2019 Реестр резерва педагогических кадров Чеченской Республики.<span></span><a
						href="text.php">Политика конфиденциальности</a></div>
			</div>
		</div>
	</footer>

</div>
<script src="js/apiCalls.js"></script>
<script src="js/main.js"></script>
<script src="js/DirectorsApi.js"></script>

</body>
</html>