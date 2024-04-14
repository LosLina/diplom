<?php

namespace Controllers;

use Core\Controller;

class Way extends Controller
{
    protected $user;
    protected $wayModel;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \Models\Users();
        $this->wayModel = new \Models\Way();
        $this->user = $this->userModel->getCurrentUser();
    }

    public function actionIndex()
    {
        global $Config;
        $title = 'Напрямки';
        $lastWay = $this->wayModel->getLastNewsWay($Config['WayCount']);
        return $this->render('index', ['lastWay' => $lastWay], [
            'MainTitle' => $title
        ]);
    }
    public function actionAddWay()
    {
        $title = 'Додавання контенту';
        if ($this->isPost()) {
            $rez = $this->wayModel->AddWay($_POST);
            if ($rez['error'] === false) {
                return $this->renderMessage('success', 'Інформацію успішно додано!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('form_way', ['model' => $_POST], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_way', null, [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);
    }

    /**
     * editing
     */
    public function actionEdit()
    {
        $id = $_GET['id'];
        $respon= $this->wayModel->getNewsWayById($id);
        $title = 'Внесення змін до публікації';
        if ($this->isPost()) {
            $rez = $this->wayModel->update($_POST, $id);
            if ($rez === true) {
                return $this->renderMessage('success', 'Публікацію успішно оновлено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('form_way', ['model' => $respon], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_way', ['model' => $respon], [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);

    }

    /**
     * delete
     */
    public function actionDelete()
    {
        $id = $_GET['id'];
        $title = 'Видалення публікації';
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            if ($this->wayModel->delete($id))
                header('Location: /response/index');
            else
                return $this->renderMessage('error', 'Помилка видалення!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $respon = $this->wayModel->getNewsWayById($id);
        return $this->render('delete_way', ['model' => $respon], [
            'MainTitle' => $title
        ]);
    }

}