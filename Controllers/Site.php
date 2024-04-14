<?php

namespace Controllers;

use Core\Controller;

class Site extends Controller
{
    protected $blogModel;
    protected $oprosModel;
    protected $responModel;
    protected $catalogModel;

    public function __construct()
    {
        $this->blogModel = new \Models\Blog();
        $this->catalogModel = new \Models\Catalog();
        $this->oprosModel = new \Models\Course();
        $this->responModel = new \Models\Response();
    }

    public function actionIndex()
    {
        global $Config;
        $lastNews = $this->blogModel->getLastNewsBlog1($Config['BlogCount']);
        $respon = $this->responModel->getLastResp($Config['RespCount']);
        $lastN = $this->catalogModel->getLastCatalog($Config['CatalogCount']);
        return $this->render('index', ['lastNews' => $lastNews, 'respon' => $respon, 'lastN' => $lastN], [
            'MainTitle' => 'Головна сторінка',
        ]);
    }

}