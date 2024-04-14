<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $MainTitle ?></title>
    <link rel="icon" href="/images/paw_cat_document_letter_icon_224687%20(2).png" type="image/x-icon">
    <link rel="shortcut icon" href="http://www.sitename.com/dirname/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/feedback/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/feedback/css/main.css">

    <link href="register.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/bw.css" rel="stylesheet">
    <link href="/css/4.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <!-- Підключення ключа API Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>

</head>
<body>
<div><a href="#top" class="idTop">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-capslock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.27 1.047a1 1 0 0 1 1.46 0l6.345 6.77c.6.638.146 1.683-.73 1.683H11.5v1a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-1H1.654C.78 9.5.326 8.455.924 7.816L7.27 1.047zM14.346 8.5L8 1.731 1.654 8.5H4.5a1 1 0 0 1 1 1v1h5v-1a1 1 0 0 1 1-1h2.846zm-9.846 5a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-1zm6 0h-5v1h5v-1z"/>
        </svg>
    </a></div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/images/paw_cat_document_letter_icon_224687%20(2).png" alt="" width="42" height="36">

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/blog">Новини</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/price">Ціни</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/way">Напрямки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/catalog">Спеціалісти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/response">Відгуки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/info">Контакти</a>
                </li>
                <? if ($user['access'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/route">Запис</a>
                    </li>
                <? endif; ?>
            </ul>
            <form class="d-flex">
                <? if (!$userModel->IsUserAut()) : ?>
                    <a href="/users/register" class="btn btn-outline-secondary me-2">Реєстрація</a>
                    <a href="/users/login" class="btn btn-secondary">Увійти</a>
                <? else: ?>
                    <span class="nav-link navbar-text "><?= $user['login'] ?></span>
                                        <div class="clearfix">
                                            <? if (is_file('Files/Users/' . $user['photo_user'] . '_s.jpg')) : ?>
                                                <img class=" img-circle icon1 me-2" src="/Files/Users/<?= $user['photo_user'] ?>_s.jpg"/>
                                            <? else: ?>
                                                <? if (is_file('Files/Users/9c2800aee7b70ffcf5842c81bb00f580.jpg')) : ?>
                                                    <img class="img-circle icon1 me-2"
                                                         src="/Files/Users/8_61e53bd5335ba_s.jpg"/>
                                                <? else: ?>
                                                    <p></p>
                                                <? endif; ?>
                                            <? endif; ?>
                                        </div>
                    <a href="/users/profile?id=<?=$user['id']?>" class="btn btn-secondary me-2">Профіль</a>
                    <a href="/users/logout" class="btn btn-secondary">Вийти</a>
                <? endif; ?>
            </form>
        </div>
    </div>
</nav>

<div class="container" >
    <h1 class="mt-5"><?= $PageTitle ?></h1>
    <? if (!empty($MessageText)): ?>
        <div class="alert alert-<?= $MessageClass ?>" role="alert">
            <?= $MessageText ?>
        </div>
    <? endif; ?>
    <? ?>
    <?= $PageContent ?>
</div>

<footer class="page-footer fixed font-small blue-grey lighten-5 mt-auto ">
    <hr class="pol" />
    <div class="container-fluid text-center text-md-center mt-5">
        <div class="row mt-3 dark-grey-text justify-content-center">
            <div class="col-md-3 col-lg-4 col-xl-3 mb-4 mx-auto">
                <h6 class="text-uppercase font-weight-bold">Щасливі Лапки</h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto w1">
                <p> Ветеринарний центр дбає про здоров'я кожного свого пацієнта. У стінах клініки для тварин працюють кваліфіковані фахівці, які люблять тварин. Це вузькоспрямовані ветлікарі по кішках та собакам, зайцеподібним, гризунам та екзотичним тваринам.

            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase font-weight-bold">Корисні посилання</h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto w1">
                <p>
                    <a class="text-secondary" href="/">Головна</a>
                </p>
                <p>
                    <a class="text-secondary" href="/price">Ціни</a>
                </p>
                <p>
                    <a class="text-secondary" href="/spesialists">Наша команда</a>
                </p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                <h6 class="text-uppercase font-weight-bold">Зв'яжіться з нами</h6>
                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto w1">
                <p>
                    <i class="fas mr-3"></i>вул. Милославська 43</p>
                <p class="text-secondary">
                    <i class="fas  mr-3"></i> 097 650-18-56<p>
                <p>
                    <i class="fas  mr-3"></i>з 9:00 до 20:00</p>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center text-black-50 py-3">&copy; 2024 Щасливі Лапки
    </div>
</footer>




<!-- Виклик функції initMap() для ініціалізації карти після завантаження сторінки -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
</script>


<!-- Подключение JS файлов -->
<script src="/feedback/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="/feedback/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="/feedback/js/main.js"></script>

<?// if ($userModel->IsUserAut()): ?>
<!--    <script src="/alian/build/ckeditor.js"></script>-->
<!--    <script>-->
<!--        let editors = document.querySelectorAll('.editor');-->
<!--        for (let i in editors) {-->
<!--            ClassicEditor-->
<!--                .create(editors[i], {-->
<!---->
<!--                    licenseKey: '',-->
<!---->
<!---->
<!--                })-->
<!--                .then(editor => {-->
<!--                    window.editor = editor;-->
<!---->
<!---->
<!--                })-->
<!--                .catch(error => {-->
<!--                    console.error('Oops, something went wrong!');-->
<!--                    console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');-->
<!--                    console.warn('Build id: n4ym7j95ja4b-nohdljl880ze');-->
<!--                    console.error(error);-->
<!--                });-->
<!--        }-->
<!--    </script>-->
<?// endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>


