<?php

namespace Controllers;

use Core\Controller;

class Info extends Controller
{
    protected $user;
    protected $infoModel;
    protected $userModel;



    public function __construct()
    {
        $this->userModel = new \Models\Users();
        $this->infoModel = new \Models\Info();

        $this->user = $this->userModel->getCurrentUser();
    }

    public function actionIndex()
    {
        global $Config;
        $title = 'Контакти';
        $lastNews = $this->infoModel->getLastNewsInfo($Config['InfoCount']);
        return $this->render('index', ['lastNews' => $lastNews], [
            'MainTitle' => $title
        ]);
    }

    /**
     * add
     */

    public function actionAddInfo()
    {
        $title = 'Додавання контенту';
        if ($this->isPost()) {
            $rez = $this->infoModel->AddInfo($_POST);
            if ($rez['error'] === false) {
//                $allowed_types = ['image/png', 'image/jpeg'];
//                if (is_file($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $allowed_types)) {
//                    switch ($_FILES['file']['type']) {
//                        case 'image/png' :
//                            $extension = 'png';
//                            break;
//                        default:
//                            $extension = 'jpeg';
//                    }
//                    $name = $rez['id'] . '_' . uniqid() . '.' . $extension;
//                    move_uploaded_file($_FILES['file']['tmp_name'], 'Files/Info/' . $name);
//                    $this->infoModel->changePhotoInfo($rez['id'], $name);
//                }

                return $this->renderMessage('success', 'Інформацію успішно додано!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('form_info', ['model' => $_POST], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_info', null, [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);
    }

    /**
     * editing
     */
    public function actionEditInfo()
    {
        $id = $_GET['id'];
        $blog = $this->infoModel->getNewsInfoById($id);
        $title = 'Редагування контенту';
        if ($this->isPost()) {
            $rez = $this->infoModel->updateNewsInfo($_POST, $id);
            if ($rez === true) {
//                $allowed_types = ['image/png', 'image/jpeg'];
//                if (is_file($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $allowed_types)) {
//                    switch ($_FILES['file']['type']) {
//                        case 'image/png' :
//                            $extension = 'png';
//                            break;
//                        default:
//                            $extension = 'jpeg';
//                    }
//                    $name = $id . '_' . uniqid() . '.' . $extension;
//                    move_uploaded_file($_FILES['file']['tmp_name'], 'Files/Info/' . $name);
//                    $this->infoModel->changePhotoInfo($id, $name);
//                }
                return $this->renderMessage('success', 'Інформацію успішно оновлено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('form_info', ['model' => $blog], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_info', ['model' => $blog], [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);

    }

    /**
     * delete
     */
    public function actionDeleteInfo()
    {
        $id = $_GET['id'];
        $title = 'Видалення';
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            if ($this->infoModel->deleteNewsInfo($id))
                header('Location: /info/index');
            else
                return $this->renderMessage('error', 'Помилка видалення інформації!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $blog = $this->infoModel->getNewsInfoById($id);
        return $this->render('delete_info', ['model' => $blog], [
            'MainTitle' => $title,
        ]);
    }


}