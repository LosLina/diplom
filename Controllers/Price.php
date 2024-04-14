<?php

namespace Controllers;

use Core\Controller;

class Price extends Controller
{
    protected $user;
    protected $priceModel;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \Models\Users();
        $this->priceModel = new \Models\Price();
        $this->user = $this->userModel->getCurrentUser();
    }

    /**
     * відображення списку цін
     */
    public function actionIndex()
    {
        global $Config;
        $title = 'Ціни';
        $lastNews = $this->priceModel->getLastPrice($Config['PriceCount']);
        return $this->render('index', ['lastPrice' => $lastNews], [
            'MainTitle' => $title,
        ]);
    }

    public function actionAddPrice()
    {
        $title = 'Додавання контенту';
        if ($this->isPost()) {
            $rez = $this->priceModel->AddPrice($_POST);
            if ($rez['error'] === false) {
                return $this->renderMessage('success', 'Інформацію успішно додано!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez['messages']);
                return $this->render('form_price', ['model' => $_POST], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_price', null, [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);
    }

    public function actionEditPrice()
    {
        $id = $_GET['id'];
        $blog = $this->priceModel->getPriceById($id);
        $title = 'Редагування контенту';
        if ($this->isPost()) {
            $rez = $this->priceModel->updatePrice($_POST, $id);
            if ($rez === true) {
                return $this->renderMessage('success', 'Інформацію успішно оновлено!', null, [
                    'MainTitle' => $title,
                    'PageTitle' => $title
                ]);
            } else {
                $message = implode('<br/> ', $rez);
                return $this->render('form_price', ['model' => $blog], [
                    'MainTitle' => $title,
                    'PageTitle' => $title,
                    'MessageText' => $message,
                    'MessageClass' => 'danger'
                ]);
            }
        } else
            return $this->render('form_price', ['model' => $blog], [
                'MainTitle' => $title,
                'PageTitle' => $title
            ]);

    }

    /**
     * delete
     */
    public function actionDeletePrice()
    {
        $id = $_GET['id'];
        $title = 'Видалення';
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            if ($this->priceModel->deletePrice($id))
                header('Location: /price/index');
            else
                return $this->renderMessage('error', 'Помилка видалення інформації!', null, [
                    'MainTitle' => $title,
                ]);
        }
        $price = $this->priceModel->getPriceById($id);
        return $this->render('delete_price', ['model' => $price], [
            'MainTitle' => $title,
        ]);
    }




}