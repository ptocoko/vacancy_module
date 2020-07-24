<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Реестр</title><!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE = edge"><![endif]-->
    <meta content="width=device-width, initial-scale=1, user-scalable=0" name="viewport">
    <link href="../img/favicon.ico" rel="icon">
    <link href="css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/vakansiya.css" rel="stylesheet">
    <link href="css/ion.rangeSlider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mystyles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="js/ion.rangeSlider.min.js"></script>
    <script src="js/teacher/Vacancy.js"></script>
    <script src="js/teacher/VacancyController.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="container">
            <div class="header__content"><a class="logo" href="../pedagogchr/frontend/index.php">Реестр резерва
                    педагогических кадров Чеченской Республики</a>
                <div class="header__nav">
                    <div class="header__nav-bg js-nav-toggle"></div>
                    <div class="header__nav-content">
                        <div class="header__nav-close js-nav-toggle"></div>
                        <div class="singin-box"><a href="../pedagogchr/frontend/index.php"><i
                                        class="icon icon-user "></i><?php echo $_SESSION['surname'] . ' ' . $_SESSION['name']; ?>
                            </a><span></span><a href="#" id="logout"><i class="icon icon-logout "></i></a>
                        </div>
                        <div class="nav">
                            <ul>
                                <li><a href="../pedagogchr/frontend/index.php">Главная</a>
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
                    <li><a href="../pedagogchr/frontend/index.php"><i class="icon icon-home "></i>Главная</a></li>
                    <li><span>Банк вакансий</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="inner">
            <div class="container">
                <h2>Банк вакансий</h2>
                <div class="base">
                    <form class="form">
                        <div class="base-box">
                            <label><span>Район</span>
                                <select id="base_areas">
                                    <option value="0000">Выберите район</option>
                                </select>
                            </label>
                            <label><span>Школа</span>
                                <select id="base_schools">
                                </select>
                            </label>
                            <label><span>Должность</span>
                                <select id="base_dolj">
                                    <option value="0">Выберите должность
                                    </option>
                                </select>
                            </label>
                            <label class="checkbox my_check text-black">
                                <input id="paymentCheck"
                                       name="zp"
                                       type="checkbox"><span></span>Без указанной зарплаты
                            </label>
                            <label><span>Зарплата</span>
                                <input id="pay-range" type="text">
                            </label>
                        </div>
                        <div class="base-box">
                            <div class="base-box__chekcs">
                                <span>Стаж работы</span>
                                <label class="checkbox text-black">
                                    <input id="staj_1" class="staj"
                                           name="exp"
                                           type="radio" value="1"><span></span>Начало
                                    карьеры,
                                    выпускник
                                </label>
                                <label class="checkbox text-black">
                                    <input id="staj_2" class="staj"
                                           name="exp"
                                           type="radio" value="2"><span></span>1-3
                                    лет
                                </label>
                                <label class="checkbox text-black">
                                    <input id="staj_3" class="staj"
                                           name="exp"
                                           type="radio" value="3"><span></span>3-5
                                    лет
                                </label>
                                <label class="checkbox text-black">
                                    <input id="staj_4" class="staj"
                                           name="exp"
                                           type="radio"
                                           value="4"><span></span>Свыше 5 лет
                                </label>
                                <label class="checkbox text-black">
                                    <input id="staj_0" class="staj"
                                           name="exp"
                                           type="radio" value="0"><span></span>Любой стаж
                                </label>
                            </div>
                        </div>
                        <div class="base-box" style="padding: 0" id="some">
                            <div class="modal-overlay" id="real_vakansiya_fon">
                                <div class="modal modal_vaca"
                                     id="real_vakansiya_modal"
                                     style="display:block;">
                                </div><!-- modal -->
                            </div><!-- overlay -->
                        </div>
                    </form>
                    <!----Результат(блоки с учителями)--------------->
                    <div id="vaca_cards">

                    </div>
                    <!----Результат(блоки с учителями)--------------->
                    <div class="base-action name" id="more">
                        <button><i class="icon icon-refresh "></i>Показать еще</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer__content"><a class="logo" href="../pedagogchr/frontend/index.php">Реестр резерва
                    педагогических кадров Чеченской
                    Республики</a>
                <div class="footer__copy">© 2019 Реестр резерва педагогических кадров Чеченской Республики.<span></span><a
                            href="text.php">Политика конфиденциальности</a></div>
            </div>
        </div>
    </footer>
</div>
<script src="js/apiCalls.js"></script>
<script src="js/teachersApi.js"></script>
<script src="js/main.js"></script>

</body>
</html>
