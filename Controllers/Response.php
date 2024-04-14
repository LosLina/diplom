<?php

namespace Controllers;

use Core\Controller;

class Response extends Controller
{
    protected $user;
    protected $responseModel;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \Models\Users();
        $this->responseModel = new \Models\Response();
        $this->user = $this->userModel->getCurrentUser();
    }

    public function actionIndex()
    {
        global $Config;
        $title = 'Відгуки';
        $respon = $this->responseModel->getLastResp($Config['RespCount']);
        return $this->render('index', ['respon' => $respon], [
            'MainTitle' => $title,
        ]);
    }
    /**
     * add
     */

    public function actionAdd()
    {
        $title = 'Додавання нової публікації';
        if (empty($this->user))
            return $this->render('err', null, [
                'MainTitle' => $title,
            ]);
        if ($this->isPost()) {
            $rez = $this->responseModel->Add($_POST);
            if ($rez['error'] === false) {
                return $this->renderMessage('success', 'Контент успішно додано!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('form', ['model' => $_POST], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form', null, [
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
        $respon= $this->responseModel->getRespById($id);
        $title = 'Внесення змін до публікації';
        if ($this->isPost()) {
            $rez = $this->responseModel->update($_POST, $id);
            if ($rez === true) {
                return $this->renderMessage('success', 'Публікацію успішно оновлено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('form', ['model' => $respon], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form', ['model' => $respon], [
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
            if ($this->responseModel->delete($id))
                header('Location: /response/index');
            else
                return $this->renderMessage('error', 'Помилка видалення!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $respon = $this->responseModel->getRespById($id);
        return $this->render('delete', ['model' => $respon], [
            'MainTitle' => $title
        ]);
    }


}