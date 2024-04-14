<?php

namespace Controllers;

use Core\Controller;

/**
 * контролер для модуля Blog
 */
class Blog extends Controller
{
    protected $user;
    protected $blogModel;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \Models\Users();
        $this->blogModel = new \Models\Blog();
        $this->user = $this->userModel->getCurrentUser();
    }

    /**
     * відображення списку новин блогу
     */
    public function actionIndex()
    {
        global $Config;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = $Config['NewsCount'] * ($page - 1);
        $title = 'Новини';
        $lastNews = $this->blogModel->getLastNewsBlog($Config['NewsCount'], $offset);
        return $this->render('index', ['lastNews' => $lastNews], [
            'MainTitle' => $title,
        ]);
    }
    /**
     * відображення новини блогу повністю
     */
    public function actionViewBlog()
    {
        $id = $_GET['id'];
        $blog = $this->blogModel->getNewsBlogById($id);
        $title = $blog['title'];
        return $this->render('view_blog', ['model' => $blog], [
            'MainTitle' => $title,
        ]);
    }

    /**
     * add
     */

    public function actionAddBlog()
    {
        $title = 'Додавання новини';
        if ($this->isPost()) {
            $rez = $this->blogModel->AddNewsBlog($_POST);
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
                    move_uploaded_file($_FILES['file']['tmp_name'], 'Files/Blogs/' . $name);
                    $this->blogModel->changePhotoBlog($rez['id'], $name);
                }

                return $this->renderMessage('success', 'Новину успішно додано!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('form_blog', ['model' => $_POST], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_blog', null, [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);
    }

    /**
     * editing
     */
    public function actionEditBlog()
    {
        $id = $_GET['id'];
        $blog = $this->blogModel->getNewsBlogById($id);
        $title = 'Внесення змін';
        if ($this->isPost()) {
            $rez = $this->blogModel->updateNewsBlog($_POST, $id);
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
                    move_uploaded_file($_FILES['file']['tmp_name'], 'Files/Blogs/' . $name);
                    $this->blogModel->changePhotoBlog($id, $name);
                }
                return $this->renderMessage('success', 'Новину успішно оновлено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('form_blog', ['model' => $blog], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_blog', ['model' => $blog], [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);

    }

    /**
     * delete
     */
    public function actionDeleteBlog()
    {
        $id = $_GET['id'];
        $title = 'Видалення новини';
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            if ($this->blogModel->deleteNewsBlog($id))
                header('Location: /blog/index');
            else
                return $this->renderMessage('error', 'Помилка видалення новини!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $blog = $this->blogModel->getNewsBlogById($id);
        return $this->render('delete_blog', ['model' => $blog], [
            'MainTitle' => $title
        ]);
    }
}