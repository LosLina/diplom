<?php

namespace Controllers;

use Core\Controller;

/**
 * контролер для модуля News
 */
class Forum extends Controller
{
    protected $user;
    protected $newsModel;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \Models\Users();
        $this->newsModel = new \Models\Forum();
        $this->user = $this->userModel->getCurrentUser();
    }

    /**
     * відображення списку
     */
    public function actionIndex()
    {
        global $Config;
        $title = 'Форум';
        $lastNews = $this->newsModel->getLastNews($Config['Forum']);
        return $this->render('index', ['lastNews' => $lastNews], [
            'MainTitle' => $title
        ]);
    }

    /**
     * відображення відгука повністю
     */
    public function actionView()
    {
        $id = $_GET['id'];
        $forum = $this->newsModel->getNewsById($id);
        $title = $forum['title'];
        return $this->render('view', ['model' => $forum], [
            'MainTitle' => $title
        ]);
    }

    public function actionAdd()
    {
        $title2 = 'Доступ заборонено!';
        if (empty($this->user))
            return $this->render('forbidden', null, [
                'MainTitle' => $title2,
                'PageTitle' => $title2
            ]);

        $title = 'Додавання повідомлення';
        if ($this->isPost()) {
            $rez = $this->newsModel->AddForum($_POST);
            if ($rez['error'] === false) {
                return $this->renderMessage('success', 'Повідомлення успішно додано!', null, [
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

    public function actionEdit()
    {
        $id = $_GET['id'];
        $forum = $this->newsModel->getNewsById($id);
        $title2 = 'Доступ заборонено!';
        if (empty($this->user) || $forum['user_id'] != $this->userModel->getCurrentUser()['id'])
            return $this->render('forbidden', null, [
                'MainTitle' => $title2,
                'PageTitle' => $title2
            ]);

        $title = 'Внесення змін';
        if ($this->isPost()) {
            $rez = $this->newsModel->updateForum($_POST, $id);
            if ($rez === true) {
                return $this->renderMessage('success', 'Дані успішно оновлено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('form', ['model' => $forum], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form', ['model' => $forum], [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);

    }

    public function actionDelete()
    {
        $id = $_GET['id'];
        $title = 'Видалення';
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes')
        {
            if ($this->newsModel->deleteForum($id))
                header('Location: /forum/index');
            else
                return $this->renderMessage('error', 'Помилка видалення коментаря!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $news = $this->newsModel->getNewsById($id);
        return $this->render('delete', ['model' => $news], [
            'MainTitle' => $title,
        ]);
    }
}