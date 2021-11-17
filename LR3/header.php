<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="lang-navbar bg-light pt-3 pb-3">
        <div class="row">
            <div class="col">
                <ul class="nav">
                    <li class="nav-item ms-2">
                        <a type="button" class="btn btn-link btn-sm" href="index.php">Главная страница</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a type="button" class="btn btn-link btn-sm" href="students.php">Фильтрация</a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul class="nav justify-content-end">
                    <?php if (isset($_SESSION['loggedUser'])) : ?>
                        <li class="nav-item ms-2 pt-1">
                            Вы авторизированы как <?php echo htmlspecialchars($_SESSION['loggedUser'])?>
                        </li>
                        <li class="nav-item ms-2 me-2">
                            <a type="button" class="btn btn-danger btn-sm" href="logout.php">Выйти</a>
                        </li>
                    <?php else : ?>

                    <li class="nav-item ms-2">
                        <a type="button" class="btn btn-primary btn-sm" href="login.php">Ввести логин и пароль</a>
                    </li>
                    <li class="nav-item ms-2 me-2">
                        <a type="button" class="btn btn-secondary btn-sm" href="signup.php">Зарегистрироваться</a>
                    </li>
                    <?php endif;?>


                </ul>
            </div>
        </div>



    </div>
<div class="mb-5 navbar-background">
    <nav class="py-2 border-bottom" >
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item"><a href="#" class="nav-link link-light px-2"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="26" viewBox="0 0 18 26"><path d="M6.66 0l.134.002h1.336c2.639 0 3.745.464 4.994 1.428 1.819 1.424 2.105 3.492 2.105 4.525 0 1.283-.393 2.638-1.356 3.742-.714.856-1.955 2.097-4.388 2.388-1.663.2-2.891.127-3.506.061v-1.306c.273.038.676.074 1.222.074 1.656 0 2.829-.827 3.543-1.719.81-.983.98-1.909 1.015-2.737h-4.555v-1.282h4.515c-.116-.866-.448-1.528-.985-2.179-1.035-1.283-2.499-1.497-3.462-1.497l-6.505-.002-.768-1.498h6.66zm-6.317 26l.804-1.564v-21.844h3.55v21.82h2.508v-8.523h3.276v8.514h2.838v-3.878c0-2.351-.122-5.622-2.77-7.311l1.542-.566c3.194 1.186 4.791 4.283 4.791 8.362v3.428l.804 1.562h-17.344z" fill="#ffffff"></path></svg></a></li>
                <li class="nav-item ms-2 text-white mt-1">
                    <p class="small-text"> <u> Национальный исследовательский университет «Высшая школа экономики» </u> > <u>Образовательные программы бакалавриата</u> > <br> <u>Факультет компьютерных наук</u> > Образовательная программа «Прикладная математика и информатика»</p>
                </li>
            </ul>
            <ul class="nav">
                <li class="nav-item">
                    <div class="btn-group btn-group-sm mt-2 me-2" role="group" aria-label="test">
                        <button type="button" class="btn btn-secondary">RU</button>
                        <button type="button" class="btn btn-light">EN</button>
                    </div>
                </li>
                <li class="nav-item"><a href="#" class="nav-link link-light px-2"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="12" viewBox="0 0 21 12"><path d="M10.5 0c3.438 0 6.937 2.016 10.5 6.047-.844.844-1.383 1.375-1.617 1.594-.234.219-.805.703-1.711 1.453-.906.75-1.641 1.266-2.203 1.547-.563.281-1.305.578-2.227.891-.922.313-1.836.469-2.742.469-1.125 0-2.156-.141-3.094-.422-.938-.281-1.875-.766-2.813-1.453-.938-.688-1.672-1.273-2.203-1.758-.531-.484-1.328-1.273-2.391-2.367 2.031-2.031 3.836-3.539 5.414-4.523 1.578-.984 3.273-1.477 5.086-1.477zm0 10.266c1.156 0 2.148-.422 2.977-1.266.828-.844 1.242-1.844 1.242-3s-.414-2.156-1.242-3c-.828-.844-1.82-1.266-2.977-1.266-1.156 0-2.148.422-2.977 1.266-.828.844-1.242 1.844-1.242 3s.414 2.156 1.242 3c.828.844 1.82 1.266 2.977 1.266zm0-5.766c0 .438.141.797.422 1.078s.641.422 1.078.422c.313 0 .625-.109.938-.328v.328c0 .688-.234 1.273-.703 1.758-.469.484-1.047.727-1.734.727-.688 0-1.266-.242-1.734-.727-.469-.484-.703-1.07-.703-1.758s.234-1.273.703-1.758c.469-.484 1.047-.727 1.734-.727h.375c-.25.313-.375.641-.375.984z" fill="#ffffff"></path></svg></a></li>
                <li class="nav-item"><a href="#" class="nav-link link-light px-2"><svg xmlns="http://www.w3.org/2000/svg" class="control_svg" width="19" height="19" viewBox="0 0 19 19"><path d="M12.927 7.9c0-1.384-.492-2.568-1.476-3.552s-2.168-1.476-3.552-1.476-2.568.492-3.552 1.476-1.476 2.168-1.476 3.552.492 2.568 1.476 3.552 2.168 1.476 3.552 1.476 2.568-.492 3.552-1.476 1.476-2.168 1.476-3.552zm4.053 11.1l-4.603-4.592c-1.339.928-2.832 1.391-4.477 1.391-1.07 0-2.093-.208-3.069-.623-.976-.415-1.818-.976-2.525-1.683-.707-.707-1.268-1.549-1.683-2.525-.415-.976-.623-1.999-.623-3.069 0-1.07.208-2.093.623-3.069.415-.976.976-1.818 1.683-2.525.707-.707 1.549-1.268 2.525-1.683.976-.415 1.999-.623 3.069-.623 1.07 0 2.093.208 3.069.623.976.415 1.818.976 2.525 1.683.707.707 1.268 1.549 1.683 2.525.415.976.623 1.999.623 3.069 0 1.646-.464 3.138-1.391 4.477l4.603 4.603-2.031 2.02z" fill="#ffffff"></path></svg></a></li>
            </ul>
        </div>
    </nav>


    <div>
        <div class="row text-white pt-5 pb-5">
            <div class="col-8 ms-5">
                <h6>Бакалаврская программа</h6>
                <h2>Прикладная математика и информатика</h2>
                <p>Целью программы является подготовка специалистов по работе с данными (data scientist), аналитиков (analyst), исследователей в области компьютерных наук (researcher and computer scientist), инженеров-разработчиков и инженеров-исследователей по программному обеспечению (software engineer and research software engineer).</p>
                <p>Программа рассчитана на молодых людей, готовящихся к развитию существующих и созданию новых компьютерных технологий, работая в ведущих ИТ-компаниях и исследовательских центрах.  Учебный план программы разработан с учетом опыта ведущих университетов, таких как Stanford University (США), EPFL (Швейцария), МГУ и МФТИ (Россия), а также Школы анализа данных Яндекса, разработавшей одну из самых сильных образовательных программ в области компьютерных наук в России.</p>
                <button type="button" class="btn btn-outline-light">Задать вопрос о программе</button>


            </div>
            <div class="col-3"></div>
        </div>
        <div class="row text-white">
            <div class="col-8 ms-5">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15"><path fill="#000" fill-rule="evenodd" d="M6.122 14.692h-3.75V7.346H0L7.958 0l7.959 7.346h-2.373v7.346h-3.75V9.795H6.123z"></path></svg></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">О программе</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">О программе</a></li>
                            <li><a class="dropdown-item" href="#">Пилотный поток</a></li>
                            <li><a class="dropdown-item" href="#">Особенности программы</a></li>
                            <li><a class="dropdown-item" href="#">Лекторы 1-2 курсов</a></li>
                            <li><a class="dropdown-item" href="#">О специализациях</a></li>
                            <li><a class="dropdown-item" href="#">Факультативы ФКН</a></li>
                            <li><a class="dropdown-item" href="#">Партнеры</a></li>
                            <li><a class="dropdown-item" href="#">Достижения студентов</a></li>
                            <li><a class="dropdown-item" href="#">Выпускники</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Абитуриентам</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Паспорт программы</a></li>
                            <li><a class="dropdown-item" href="#">Траектории поступления</a></li>
                            <li><a class="dropdown-item" href="#">Карманный словарь абитуриента</a></li>
                            <li><a class="dropdown-item" href="#">Подготовка</a></li>
                            <li><a class="dropdown-item" href="#">Стипендии для поступивших</a></li>
                            <li><a class="dropdown-item" href="#">Будущая профессия</a></li>
                            <li><a class="dropdown-item" href="#">Онлайн-подготовка</a></li>
                            <li><a class="dropdown-item" href="#">Тестирование поступивших</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Студентам</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Доска объявлений</a></li>
                            <li><a class="dropdown-item" href="#">Выбор траектории обучения</a></li>
                            <li><a class="dropdown-item" href="#">Курсы по выбору 2021-22</a></li>
                            <li><a class="dropdown-item" href="#">Специализации</a></li>
                            <li><a class="dropdown-item" href="#">Практическая подготовка</a></li>
                            <li><a class="dropdown-item" href="#">Проекты</a></li>
                            <li><a class="dropdown-item" href="#">Project Proposal</a></li>
                            <li><a class="dropdown-item" href="#">Итоговая аттестация</a></li>
                            <li><a class="dropdown-item" href="#">Каталог ВКР</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Выпускникам</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Общая информация</a></li>
                            <li><a class="dropdown-item" href="#">Вышка.Family</a></li>
                            <li><a class="dropdown-item" href="#">Центр развития карьеры</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</div>