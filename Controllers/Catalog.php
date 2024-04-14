<?php

namespace Controllers;

use Core\Controller;

class Catalog extends Controller
{
    protected $user;
    protected $catalogModel;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \Models\Users();
        $this->catalogModel = new \Models\Catalog();
        $this->user = $this->userModel->getCurrentUser();
    }

    public function actionIndex()
    {
            global $Config;
            $title = 'Спеціалісти';
            $lastNews = $this->catalogModel->getLastCatalog($Config['CatalogCount']);
            return $this->render('index', ['last' => $lastNews], [
                'MainTitle' => $title,
            ]);
    }


    public function actionFiltersYearU()
    {
        $title = 'Спеціалісти';
        $param = $_GET['r1'];
        $lastNews = $this->catalogModel->getFilt2($param);
        return $this->render('filters', ['last' => $lastNews], [
            'MainTitle' => $title,
        ]);
    }

    public function actionFiltersYearD()
    {
        $title = 'Спеціалісти';
        $param = $_GET['r2'];
        $lastNews = $this->catalogModel->getFilt22($param);
        return $this->render('filters', ['last' => $lastNews], [
            'MainTitle' => $title,
        ]);
    }

    public function actionFiltersNameU()
    {
        $title = 'Спеціалісти';
        $param = $_GET['n1'];
        $lastNews = $this->catalogModel->getFilt3($param);
        return $this->render('filters', ['last' => $lastNews], [
            'MainTitle' => $title,
        ]);
    }

    public function actionFiltersNameD()
    {
        $title = 'Спеціалісти';
        $param = $_GET['n2'];
        $lastNews = $this->catalogModel->getFilt33($param);
        return $this->render('filters', ['last' => $lastNews], [
            'MainTitle' => $title,
        ]);
    }

//    public function actionSearch()
//    {
//        $title = 'Спеціалісти';
//        $param = $_GET['search'];
//        $lastNews = $this->catalogModel->getSearch($param);
//        return $this->render('filters', ['last' => $lastNews], [
//            'MainTitle' => $title,
//        ]);
//    }

    /**
     * відображення повністю
     */
    public function actionView()
    {
        $id = $_GET['id'];
        $blog = $this->catalogModel->getCatalogById($id);
        $title = $blog['title'];
        return $this->render('view_catalog', ['model' => $blog], [
            'MainTitle' => $title,
        ]);
    }

    /**
     * add
     */

    public function actionAdd()
    {
        $title = 'Додавання нової публікації';
//        if (empty($this->user))
//            return $this->render('err', null, [
//                'MainTitle' => $title,
//            ]);
        if ($this->isPost()) {
            $rez = $this->catalogModel->AddCatalog($_POST);
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
//                    move_uploaded_file($_FILES['file']['tmp_name'], 'Files/Catalog/' . $name);
//                    $this->catalogModel->changePhoto($rez['id'], $name);
//                }

                return $this->renderMessage('success', 'Контент успішно додано!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('form_catalog', ['model' => $_POST], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_catalog', null, [
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
        $blog = $this->catalogModel->getCatalogById($id);
        $title = 'Внесення змін до публікації';
        if ($this->isPost()) {
            $rez = $this->catalogModel->updateCatalog($_POST, $id);
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
//                    move_uploaded_file($_FILES['file']['tmp_name'], 'Files/Catalog/' . $name);
//                    $this->catalogModel->changePhoto($id, $name);
//                }
                return $this->renderMessage('success', 'Публікацію успішно оновлено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('form_catalog', ['model' => $blog], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_catalog', ['model' => $blog], [
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
            if ($this->catalogModel->deleteCatalog($id))
                header('Location: /catalog/index');
            else
                return $this->renderMessage('error', 'Помилка видалення!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $blog = $this->catalogModel->getCatalogById($id);
        return $this->render('delete_catalog', ['model' => $blog], [
            'MainTitle' => $title
        ]);
    }
}