<?php

namespace Controllers;

use Core\Controller;

class Users extends Controller
{
    protected $userModel;
    protected $oprosModel;
    protected $noteModel;

    function __construct()
    {
        $this->userModel = new \Models\Users();
        $this->noteModel = new \Models\Note();
        $this->oprosModel = new \Models\Course();
        $this->userModel->getCurrentUser();
    }

    function actionLogout()
    {
        $title = 'Вихід';
        $title2 = 'Вихід з акаунту';
        unset($_SESSION['user']);
        return $this->renderMessage('success', 'Ви успішно вийшли з акаунту!', null, [
            'MainTitle' => $title,
            'PageTitle' => $title2
        ]);
    }

    function actionLogin()
    {
        $title = 'Вхід';
        $title2 = 'Вхід на сайт';
        if (isset($_SESSION['user']))
            return $this->renderMessage('success', 'Ви вже увійшли на сайт!', null, [
                'MainTitle' => $title,
                'PageTitle' => $title2
            ]);

        if ($this->isPost()) {
            $user = $this->userModel->AuthUser($_POST['login'], $_POST['password']);
            if (!empty($user)) {
                $_SESSION['user'] = $user;
                return $this->renderMessage('success', 'Успішний вхід на сайт!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title2
                ]);
            } else {
                return $this->render('login', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title2,
                    'MessageText' => 'Не коректно заповнено поле "Логін" чи "Пароль"!',
                    'MessageClass' => 'danger'
                ]);
            }
        } else {
            $params = [
                'MainTitle' => $title,
                'PageTitle' => $title2
            ];
            return $this->render('login', null, $params);
        }
    }

    function actionRegister()
    {
        if ($this->isPost()) {
            $rez = $this->userModel->AddUser($_POST);
            //=== чітко перевірить що буде в результаті
            if ($rez['error'] === false) {
                $allowed_types = ['image/png', 'image/jpeg'];
                if (is_file($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $allowed_types)) {
                    switch ($_FILES['file']['type']) {
                        case 'image/png' :
                            $extension = 'png';
                            break;
                        default:
                            $extension = 'jpeg';
                    }
                    $name = $rez['id'] . '_' . uniqid() . '.' . $extension;
                    move_uploaded_file($_FILES['file']['tmp_name'], 'Files/Users/' . $name);
                    $this->userModel->changePhoto($rez['id'], $name);
                }
                return $this->renderMessage('success', 'Користувач успішно зареєстрований!', null, [
                    'MainTitle' => 'Реєстрація',
                    'PageTitle' => 'Реєстрація на сайті'
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('register', null, [
                    'MainTitle' => 'Реєстрація',
                    'PageTitle' => 'Реєстрація на сайті',
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else {
            $params = [
                'MainTitle' => 'Реєстрація',
                'PageTitle' => 'Реєстрація на сайті'
            ];
            return $this->render('register', null, $params);
        }
    }

    function actionProfile()
    {
        global $Config;
        $title = 'Профіль';
        $id = $_GET['id'];
        $user = $this->userModel->getUserById($id);
        $last = $this->noteModel->getLastNote($Config['NoteCount']);
        if (isset($_SESSION['user']))
            return $this->render('profile', ['model' => $user, 'last' => $last], [
                'MainTitle' => $title
            ]);
    }


    public function actionEdit()
    {
        $id = $_GET['id'];
        $user = $this->userModel->getUserById($id);
        $title = 'Редагування профілю';
        if ($this->isPost()) {
            $rez = $this->userModel->updateUser2($_POST, $id);
            if ($rez === true) {
                $allowed_types = ['image/png', 'image/jpeg'];
                if (is_file($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $allowed_types)) {
                    switch ($_FILES['file']['type']) {
                        case 'image/png' :
                            $extension = 'png';
                            break;
                        default:
                            $extension = 'jpeg';
                    }
                    $name = $id . '_' . uniqid() . '.' . $extension;
                    move_uploaded_file($_FILES['file']['tmp_name'], 'Files/Users/' . $name);
                    $this->userModel->changePhoto($id, $name);
                }
                return $this->renderMessage('success', 'Дані успішно оновлено!', null, [
                    'MainTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('edit', ['model' => $user], [
                    'MainTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('edit', ['model' => $user], [
                'MainTitle' => $title
            ]);

    }

    /**
     * delete
     */
    public function actionDeleteUser()
    {
        $id = $_GET['id'];
        $title = 'Видалення профілю';
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            if ($this->userModel->deleteUser($id)) {
                unset($_SESSION['user']);
                return $this->renderMessage('success', 'Профіль успішно видалено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else
                return $this->renderMessage('error', 'Помилка видалення профілю!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $blog = $this->userModel->getUserById($id);
        return $this->render('delete_user', ['model' => $blog], [
            'MainTitle' => $title,
        ]);
    }


}