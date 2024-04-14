<?php

namespace Models;

use Core\Utils;
use Imagick;

class Catalog extends \Core\Model
{

    public function AddCatalog($newsRow)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null) {
            $rez = [
                'error' => true,
                'messages' => ['Користувач не аутентифікований!']
            ];
            return $rez;
        }
        $valRez = ($this->Validate($newsRow));
        if (is_array($valRez)) {
            $rez = [
                'error' => true,
                'messages' => $valRez
            ];
            return $rez;
        }
        $fields = ['name', 'surname', 'pobat', 'experience', 'way'];
        $RowFilter = Utils::ArrFilter($newsRow, $fields);
        //$RowFilter['photo'] = '...photo';
        //$RowFilter['avtor_id'] = $user['id'];
        $id = \Core\core::getInstance()->getDB()->insert('specialists', $RowFilter);
        return [
            'error' => false,
            'id' => $id
        ];
    }

//    public function changePhoto($id, $file)
//    {
//        $folder = 'Files/Catalog/';
//        $file_path = pathinfo($folder . $file);
//        $file_normal = $file_path['filename'] . '_n';
//        $ser = $this->getCatalogById($id);
//        if (is_file($folder . $ser['photo'] . '_n.jpg') && is_file($folder . $file))
//            unlink($folder . $ser['photo'] . '_n.jpg');
//        $ser['photo'] = $file_path['filename'];
//        $im_n = new Imagick();
//        $im_n->readImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . $file);
//        $im_n->cropThumbnailImage(375, 506, true);
//        $im_n->writeImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . '/' . $file_normal . '.jpg');
//
//        unlink($folder . $file);
//        $this->updateCatalog($ser, $id);
//    }

    public function Validate($newsRow)
    {
        $errors = [];
        if (empty($newsRow['name']))
            $errors[] = 'Поле "Ім\'я" не може бути порожнім!';
        if (empty($newsRow['surname']))
            $errors[] = 'Поле "Прізвище" не може бути порожнім!';
        if (empty($newsRow['pobat']))
            $errors[] = 'Поле "По-батькові" не може бути порожнім!';
        if (empty($newsRow['experience']))
            $errors[] = 'Поле "Стаж" не може бути порожнім!';
        if (empty($newsRow['way']))
            $errors[] = 'Поле "Спеціалізація" не може бути порожнім!';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function getLastCatalog($count)
    {
        return \Core\core::getInstance()->getDB()->select('specialists', '*', null, $count);
    }

    public function getFilt2($count)
    {
        return \Core\core::getInstance()->getDB()->select('specialists', '*', null, ['experience' => 'ASC'], $count);
    }

    public function getFilt22($count)
    {
        return \Core\core::getInstance()->getDB()->select('specialists', '*', null, ['experience' => 'DESC'], $count);
    }
//
    public function getFilt3($count)
    {
        return \Core\core::getInstance()->getDB()->select('specialists', '*', null, ['surname' => 'ASC'], $count);
    }

    public function getFilt33($count)
    {
        return \Core\core::getInstance()->getDB()->select('specialists', '*', null, ['surname' => 'DESC'], $count);
    }

    public function getCatalogById($id)
    {
        $forum = \Core\core::getInstance()->getDB()->select('specialists', '*', ['id' => $id]);
        if (!empty($forum))
            return $forum[0];
        else
            return null;
    }


//    public function getSearch($search)
//    {
//        return \Core\core::getInstance()->getDB()->search('specialists', $search);
//
//    }

    public function updateCatalog($row, $id)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null)
            return false;
        $valRez = ($this->Validate($row));
        if (is_array($valRez))
            return $valRez;
        $fields = ['name', 'surname', 'pobat', 'experience', 'way'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        \Core\core::getInstance()->getDB()->update('specialists', $RowFilter, ['id' => $id]);
        return true;
    }

    public function deleteCatalog($id)
    {
        $news = $this->getCatalogById($id);
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if (empty($news) || empty($user) || $user['access'] != 1)
            if ($user['id'] != $news['id'])
                return false;
        \Core\core::getInstance()->getDB()->delete('specialists', ['id' => $id]);
        return true;

    }

}