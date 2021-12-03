<?php
require 'service/auth.php';
$u = Auth::checkLogin();
if ($u === false) {
    header("Location: /login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>mainPage</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4ba8d6f6b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<nav class="navbar navbar-light navbar-expand-md" style="padding-left: 5%;padding-right: 5%;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <svg width="178" height="44" viewBox="0 0 178 44" fill="none" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="178" height="44" fill="url(#pattern0)"/>
                <defs>
                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                        <use xlink:href="#image0_28_1000"
                             transform="translate(-0.00388937) scale(0.00475367 0.0192308)"/>
                    </pattern>
                    <image id="image0_28_1000" width="212" height="52"
                           xlink:href="data:image/png;base64,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"/>
                </defs>
            </svg>
        </a>
        <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol"><span class="visually-hidden">Toggle navigation</span><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse gap-4" id="navcol" style="padding-left: 5%;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class='d-flex justify-content-center flex-column'>
                        <a class="nav-current" href="#" id='link_bank'>О БАНКЕ</a>
                        <div class='line'></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class='d-flex justify-content-center flex-column'>
                        <a class="nav-other" href="#" id='link_coll'>КОЛЛЕГИ</a>
                        <div class='empty-line'></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class='d-flex justify-content-center flex-column'>
                        <a class="nav-other" href="#" id='link_base'>БАЗЫ ЗНАНИЙ</a>
                        <div class='empty-line'></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class='d-flex justify-content-center flex-column'>
                        <a class="nav-other" href="#" id='link_comm'>СООБЩЕСТВА</a>
                        <div class='empty-line'></div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class='d-flex justify-content-center flex-column'>
                        <a class="nav-other" href="#" id='link_task'>ЗАДАЧИ</a>
                        <div class='empty-line'></div>
                    </div>
                </li>
            </ul>
            <a class='image-button navbar-ico' href="#"><i class="fa fa-user-circle fa-2x"></i></a>
            <a id="notifications" tabindex="0" class='image-button navbar-ico' href="javascript:void(0)" data-bs-trigger="focus" data-bs-toggle="popover" data-bs-placement="bottom" title="Уведомления" data-bs-content="Так держать, всё прочитано!"><i class="fa fa-bell fa-2x"></i></a>
            <a class='image-button navbar-ico' href="#"><i class="fa fa-comments fa-2x"></i></a>
            <a class='image-button navbar-ico' href="#"><i class="fa fa-search fa-2x"></i></a>
        </div>
    </div>
</nav>
<!-- Заголовок -->
<div class="container paper pt-3">
    <div class="row">
        <div class="col-md-4" style="padding-left:3em">
            <img src="assets/img/big_avatar.png" class="big-avatar" alt="">
            <div class="row">
                <div class="col"><i class="fa fa-paper-plane-o fa-2x custom-link" style="margin-left: 10%;"></i><a class='custom-link' href="https://t.me/egorkk">TELEGRAM</a></div>
            </div>
        </div>
        <div class="col-md-4">
            <p class='text-header'>Смурыгин Егор Алексеевич</p>
            <p class='text-description'>Главный специалист по работе с ключевыми клиентами.</p>
            <p class='text-paragraph'>Группа внутренних коммуникаций и развития корпоративной культуры / Департамент управления персоналом / Подразд. под упр. Барыбина О. Г.</p>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col text-right">
                    <p><i class="fa fa-fax" style="margin-right: 6px;"></i>(1234) 56-7890&nbsp; &nbsp; (9876) 54-3210</p>
                    <p><i class="fa fa-mobile-phone contact-phone"></i>&nbsp;+7 (903) 676-8494</p>
                    <p><i class="fas fa-at"></i> esmurygin@moscow.psbank.ru</p>
                    <p><i class="fa fa-map-pin contact-phone"></i>Москва, Дербеневская Набережная, д. 7, стр./корпус 22, подъезд А, 2 этаж, Open Space 1240, место 127</p>
                </div>
            </div>
        </div>
    </div>
    <div class='line-split'></div>
    <div class="row">
        <div class="col">
            <nav class="navbar navbar-light navbar-expand-md my-2">
                <div class="container-fluid">
                    <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span
                            class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navcol-card">
                        <ul class="navbar-nav text-center d-flex align-items-center">
                            <li class="nav-item"><a class="nav-current" href="#">РАБОЧИЙ СТОЛ</a></li>
                            <li class="nav-item"><a class="nav-other" href="#">ПРОФИЛЬ</a></li>
                            <li class="nav-item"><a class="nav-other" href="#">АДАПТАЦИЯ</a></li>
                            <li class="nav-item"><a class="nav-other" href="#">ЗАДАЧИ</a></li>
                            <li class="nav-item"><a class="nav-other" href="#">ЛЬГОТЫ</a></li>
                            <li class="nav-item"><a class="nav-other" href="#">ОТСУТСТВИЯ</a></li>
                            <li class="nav-item"><a class="nav-other" href="#">ПОЛЕЗНЫЕ ССЫЛКИ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Адаптация -->
<div class="container paper pt-3">
    <div class="row">
        <div class="col" style="margin-left: 1em;">
            <p style="font-size: 2em;">Адаптация</p>
            <p>3 новых&nbsp; &nbsp;<span style="color:#A0A0A0"> 2 выполнено</span></p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th><div class="form-check"><input class="form-check-input input-checkbox disabled" disabled type="checkbox"><label class="form-check-label" style="padding-left: 1em;" for="formCheck-1">Наименование</label></div></th>
                <th>Дата исполнения</th>
                <th>Поставщик</th>
                <th>Cтатус</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em">Завести заявку на подготовку рабочего места</td>
                <td>5 декабря 8:00</td>
                <td class='d-flex align-items-center' style='border:0'>
                    <img src="assets/img/belou.png" class="belou" alt="">&nbsp; &nbsp; Белоусова Н.М.</td>
                <td>
                    <span class="badge bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="dot bi bi-dot">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                    </svg>
                        Новое
                    </span>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em">Открыть доступ для Качаловой Т. А.
                </td>
                <td class='text-big'>—</td>
                <td class='d-flex align-items-center' style='border:0;'>
                    <img src="assets/img/oresh.png" class="oresh">&nbsp; &nbsp; Орешникова Н.М.
                </td>
                <td><span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class='dot' width="1em"
                                                        height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                        class="bi bi-dot">
	                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                                </svg>Новое</span></td>
            </tr>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em">Открыть доступ к рабочему столу для Качаловой Т. А.
                </td>
                <td class='text-big'>—</td>
                <td class='d-flex align-items-center' style='border:0'>
                    <img src="assets/img/vined.png" class="vined">&nbsp; &nbsp; Винедиктова А.М.
                </td>
                <td><span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class="dot" width="1em"
                                                        height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                        class="bi bi-dot">
	                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                                </svg>Новое</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Задачи -->
<div class="container paper pt-3">
    <div class="row">
        <div class="col" style="margin-left: 1em;">
            <p style="font-size: 2em;">Задачи</p>
            <p>3 в работе&nbsp; &nbsp;<span style="color:#A0A0A0">0 помогаю&nbsp; &nbsp;0 поручаю&nbsp; &nbsp;0 наблюдаю</span></p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th><div class="form-check"><input class="form-check-input input-checkbox disabled" disabled type="checkbox"><label class="form-check-label" style="padding-left: 1em;" for="formCheck-1">Наименование</label></div></th>
                <th>Дата исполнения</th>
                <th>Поставщик</th>
                <th>Cтатус</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em"><span style="color: #FF5252;">Запись о приёме на работу Евгений Шамрай</span></td>
                <td>5 декабря 8:00</td>
                <td class='d-flex align-items-center' style='border:0'>
                    <img src="assets/img/belou.png" class="belou" alt="">&nbsp; &nbsp; Белоусова Н.М.</td>
                <td>
                    <span class="badge bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="dot bi bi-dot">
                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                    </svg>
                        Новое
                    </span>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em">Поставить дизайнеру задачу
                </td>
                <td class='text-big'>—</td>
                <td class='d-flex align-items-center' style='border:0;'>
                    <img src="assets/img/oresh.png" class="oresh">&nbsp; &nbsp; Орешникова Н.М.
                </td>
                <td><span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class="dot-complete"
                                                        width="1em" height="1em" fill="currentColor"
                                                        viewBox="0 0 16 16" class="bi bi-dot">
	                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                                    </svg>Завершено</span></td>
            </tr>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em">Дать комментарий в Jira<span style="color:#FCAA2E;"><svg
                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                        viewBox="0 0 16 16" class="bi bi-lightning" style="margin-left: 10px;">
	                                    <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641l2.5-8.5zM6.374 1 4.168 8.5H7.5a.5.5 0 0 1 .478.647L6.78 13.04 11.478 7H8a.5.5 0 0 1-.474-.658L9.306 1H6.374z"></path>
	                                </svg></span>
                    <button id="active-clock" disabled class="btn btn-outline-success shadow-none" type="button"
                            style="margin-right: 7px;margin-left: 7px;"><i class="fa fa-play" style="margin-right: 10px;"></i><span
                            style="color:white">0:07:21</span>
                </td>
                <td class='text-big'>—</td>
                <td class='d-flex align-items-center' style='border:0'>
                    <img src="assets/img/vined.png" class="vined">&nbsp; &nbsp; Винедиктова А.М.
                </td>
                <td><span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class='dot-progress'
                                                        width="1em" height="1em" fill="currentColor"
                                                        viewBox="0 0 16 16" class="bi bi-dot">
	                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                                    </svg>В работе</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Услуги -->
<div class="container paper pt-3">
    <div class="row">
        <div class="col" style="margin-left: 1em;">
            <p style="font-size: 2em;">Услуги</p>
            <p>3 заказа&nbsp; &nbsp;<span style="color:#A0A0A0">0 в работе&nbsp; &nbsp;0 делегировано&nbsp; &nbsp;0 наблюдаю</span></p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th><div class="form-check"><input class="form-check-input input-checkbox disabled" disabled type="checkbox"><label class="form-check-label" style="padding-left: 1em;" for="formCheck-1">Наименование</label></div></th>
                <th>Дата исполнения</th>
                <th>Поставщик</th>
                <th>Cтатус</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em">Завести заявку на подготовку рабочего места</td>
                <td>5 декабря 8:00</td>
                <td class='d-flex align-items-center' style='border:0'>
                    <img src="assets/img/belou.png" class="belou" alt="">&nbsp; &nbsp; Белоусова Н.М.</td>
                <td>
                    <span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class='dot-progress'
                                                        width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                        class="bi bi-dot">
	                                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                                        </svg>На уточнении</span>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em">Открыть доступ для Качаловой Т. А.
                </td>
                <td class='text-big'>—</td>
                <td class='d-flex align-items-center' style='border:0;'>
                    <img src="assets/img/oresh.png" class="oresh">&nbsp; &nbsp; Орешникова Н.М.
                </td>
                <td><span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class='dot-complete'
                                                        width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                        class="bi bi-dot">
	                                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                                        </svg>Завершено</span></td>
            </tr>
            <tr>
                <td><input type="checkbox" class='form-check-input input-checkbox' style="margin-right: 1em">Открыть доступ к рабочему столу для Качаловой Т. А.
                </td>
                <td class='text-big'>—</td>
                <td class='d-flex align-items-center' style='border:0'>
                    <img src="assets/img/vined.png" class="vined">&nbsp; &nbsp; Винедиктова А.М.
                </td>
                <td><span class="badge bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class='dot-progress'
                                                        width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                        class="bi bi-dot">
	                                            <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
	                                        </svg>На согласовании</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="container" style="height: 410px;">
    <div class="row" style="margin-right: 0; padding: 10px 0 0; height: 410px;">
        <div class="col-md-4 paper" style="margin-left: -10px; margin-right: 5px;">
            <div class="row" style="margin-top: 10px;">
                <div class="col">
                    <h4>Неиспользованные дни отпуска</h4>
                </div>
            </div>
            <p>Узнай сколько дней отпуска у тебя есть.&nbsp; Выбери дату начала отпуска:</p>
            <div class="row">
                <div class="col d-xl-flex align-items-xl-start"><input id='vacinput' type="date" class='input-date'
                                                                       style="margin-top: 5px;"></div>
                <div class="col d-xl-flex flex-grow-1 justify-content-xl-center align-items-xl-start">
                    <button id="vacbtn" class="btn input-button shadow" type="button" style="width: 80%;">Узнать</button>
                </div>
            </div>
            <div class='row d-flex justify-content-center align-items-end' style='height: 200px;'>
                <img src="assets/img/psb.jpg" class="psb mt-auto">
            </div>
        </div>
        <div class="col-md-4 paper" style="margin-right: 10px;margin-left: 5px;">
            <div class="row" style="margin-top: 10px;">
                <div class="col">
                    <h4>Обучение</h4>
                </div>
            </div>
            <p style="margin-bottom: 0;"><a href="#" class='custom-link'>Личный кабинет</a></p>
            <p style="margin-left: 0.5em">на портале "Про Движение"</p>
            <div class='row d-flex align-items-end flex-column' style="height:250px">
                <img src="assets/img/globe.png" class="globe mt-auto">
            </div>
        </div>
        <div class="col-md-4 paper" style="margin-left: 0;margin-right: -20px; padding-right:0;">
            <div class="row"  style="margin-top: 10px;">
                <div class="col">
                    <h4>Достижения</h4>
                </div>
            </div>
            <div class='d-flex justify-content-between' style="height:340px;">
                <div>
                    <i>Достижений пока нет...</i>
                </div>
                <div class='d-flex aligh-items-end flex-column'>
                    <img src="assets/img/chel.png" class="chel mt-auto">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let clock = document.getElementById('active-clock');
    let seconds = 5 * 60 + 27;
    let int = setInterval(() => {
        let minutes = seconds / 60 | 0;
        let secondsleft = seconds - minutes * 60
        if (secondsleft < 10) secondsleft = "0"+secondsleft;
        let crts = "0:0"+minutes + ":" + secondsleft;
        seconds -= 1;
        if (seconds < 0) clearInterval(int);
        clock.innerHTML = '<i class="fa fa-play" style="margin-right: 10px;"></i> <span style="color:white">'+crts+'</span>';
    }, 1000);
    $(document).ready(function () {
        $('input[type="checkbox"].input-checkbox').on('click', function () {
            if (confirm("Вы уверены что хотите удалить эту задачу?")) {
                $(this).parent().parent().remove();
            } else {
                $(this).prop('checked', false);
            }
        });
        $('#vacbtn').on('click', function () {
            let vacinput = $('#vacinput').val();
            if (vacinput === "") alert("Укажите корректную дату!");
            else alert("У тебя 0 неиспользованных дней отпуска!");
        });
        $('#notifications').on('click', function () {
            $(this).popover('toggle');
        });
    });
</script>
</body>

</html>
