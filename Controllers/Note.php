<?php

namespace Controllers;

use Core\Controller;

class Note extends Controller
{
    protected $noteModel;
    public function __construct()
    {
        $this->noteModel = new \Models\Note();


    }
    public function actionAdd()
    {
        $title = 'Форма запису';
        if ($this->isPost()) {
            $rez = $this->noteModel->Add($_POST);
            if ($rez['error'] === false) {
                return $this->renderMessage('success', 'Успішно відправлено!', null, [
                    'MainTitle' => $title,
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('forms', ['model' => $_POST], [
                    'MainTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('forms', null, [
                'MainTitle' => $title,
            ]);
    }

    public function actionDelete()
    {
        $id = $_GET['id'];
        $title = 'Видалення';
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            if ($this->noteModel->delete($id))
                header('Location: /users/profile?id=1');
            else
                return $this->renderMessage('error', 'Помилка видалення!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $services = $this->noteModel->getNoteById($id);
        return $this->render('delete', ['model' => $services], [
            'MainTitle' => $title
        ]);
    }
    public function actionEdit()
    {
        $id = $_GET['id'];
        $ser = $this->noteModel->getNoteById($id);
        $title = 'Внесення змін';
        if ($this->isPost()) {
            $rez = $this->noteModel->update($_POST, $id);
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