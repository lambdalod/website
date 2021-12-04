<?php
require '../service/auth.php';
$u = Auth::checkLogin();
if ($u === false) {
    header("Location: ../login?back=officetour");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <style>
        html, body { margin: 0; height: 100%; overflow: hidden }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Тур по офису ПСБ</title>
    <link rel="icon" href="../assets/favicon.png">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css?h=1f5647dc65bf3adb596e93a82c7ae8af">
    <script src="https://kit.fontawesome.com/4ba8d6f6b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css?h=8b9825c30a51ef8cbbc1c11ccec72161">
</head>
<body>
    <div class="flex-row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="d-flex justify-content-center pt-5" style="height: 10vh;">
                <img src="img/img_1.png" class="newton" alt="">
            </div>
            <div style="height: 3em"></div>
            <div style="height: calc(100% - 10vh - 3em);">
                <div class="d-flex flex-row">
                    <div class="paper" id="text-s"></div>
                </div>

                <div style="height: 100%">
                    <div class="d-flex flex-row justify-content-end">
                        <div>
                            <img src="img/img_2.png" style="height: 40vh;margin-top:-40px;background-size:cover;" alt="">
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <button id="nextbtn" class="btn input-button shadow-none" type="button" style="width:100%;padding:0;">На портал</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js?h=5488c86a1260428f0c13c0f8fb06bf6a"></script>
    <script>
        const tour = [
            "<p>Привет, вы находитесь в головном офисе <span>\"ПСБ\"</span>.</p><p>В данной комнате происходит основной рабочий процесс.</p>",
            "<p>Давайте познакоимся с корпоративными ценностями!</p><div class=\"justify-content-center d-flex\"><img src=\"img/img.png\" class=\"image\"></div>",
            "<p>В нашей компании важно:</p><p>Иметь <span>широту </span>взгляда</p><p>Обладать личной <span>ответственностью</span></p><p>Быть одним целым с <span>командой</span></p><p>О наших основных принципах можно ознакомиться на портале онбординга</p>"
        ]
        const btn = [
            "Далее",
            "<img src=\"img/img_8.png\" style=\"width: 10vh\" alt=\"->\">",
            "На портал"
        ]
        let i = 0;
        let stop = false;
        $(document).ready(function () {
            $('#text-s').html(tour[i]);
            $('#nextbtn').html(btn[i]);
        });
        $('#nextbtn').on('click', function () {
            if (stop === false) {
                i += 1;
                $('#text-s').html(tour[i]);
                $('#nextbtn').html(btn[i]);
                if ((i + 1) === tour.length) {
                    stop = true;
                    $('#nextbtn').remove();
                }
            }
        });
    </script>
</body>
</html>