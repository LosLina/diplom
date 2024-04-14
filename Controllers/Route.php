<?php

namespace Controllers;

use Core\Controller;

class Route extends Controller
{
    protected $oprosModel;
    public function __construct()
    {
        $this->oprosModel = new \Models\Course();
    }
    public function actionIndex()
    {
        global $Config;
        $title = 'Запис';
        $last = $this->oprosModel->getLastOpros($Config['InfoCount']);
        return $this->render('index', ['last' => $last], [
            'MainTitle' => $title
        ]);
    }
    public function actionAdd()
    {
        $title = 'Форма зворотнього зв\'язку';
        if ($this->isPost()) {
            $rez = $this->oprosModel->Add($_POST);
            if ($rez['error'] === false) {
                return $this->renderMessage('success', 'Успішно відправлено!', null, [
                    'MainTitle' => $title,
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('form', ['model' => $_POST], [
                    'MainTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form', null, [
                'MainTitle' => $title,
            ]);
    }

    public function actionDelete()
    {
        $id = $_GET['id'];
        $title = 'Видалення';
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            if ($this->oprosModel->delete($id))
                header('Location: /users/profile?id=1');
            else
                return $this->renderMessage('error', 'Помилка видалення!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $services = $this->oprosModel->getOprosById($id);
        return $this->render('delete', ['model' => $services], [
            'MainTitle' => $title
        ]);
    }
    public function actionEdit()
    {
        $id = $_GET['id'];
        $ser = $this->oprosModel->getOprosById($id);
        $title = 'Внесення змін';
        if ($this->isPost()) {
            $rez = $this->oprosModel->update($_POST, $id);
            if ($rez === true) {
                return $this->renderMessage('success', 'Позицію успішно оновлено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('edit', ['model' => $ser], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('edit', ['model' => $ser], [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);

    }


}