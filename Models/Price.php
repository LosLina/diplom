<?php

namespace Models;

use Core\Utils;

class Price extends \Core\Model
{
    public function AddPrice($priceRow)
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
        $valRez = ($this->ValidateInfo($priceRow));
        if (is_array($valRez)) {
            $rez = [
                'error' => true,
                'messages' => $valRez
            ];
            return $rez;
        }
        $fields = ['name', 'value'];
        $RowFilter = Utils::ArrFilter($priceRow, $fields);
        $RowFilter['datetime'] = date('Y-m-d H:i:s');//2021-01-13 18:00:00
        $id = \Core\core::getInstance()->getDB()->insert('price', $RowFilter);
        return [
            'error' => false,
            'id' => $id
        ];
    }
    public function getLastPrice($count)
    {
        return \Core\core::getInstance()->getDB()->select('price', '*', null, ['id' => 'ASC'], $count);

    }

    public function ValidateInfo($infoRow)
    {
        $errors = [];
        if (empty($infoRow['name']))
            $errors[] = 'Поле "Назва" не може бути порожнім!';
        if (empty($infoRow['value']))
            $errors[] = 'Поле "Ціна" не може бути порожнім!';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }
    public function getPriceById($id)
    {
        $info = \Core\core::getInstance()->getDB()->select('price', '*', ['id' => $id]);
        if (!empty($info))
            return $info[0];
        else
            return null;
    }
    public function updatePrice($row, $id)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null)
            return false;
        $valRez = ($this->ValidateInfo($row));
        if (is_array($valRez))
            return $valRez;
        $fields = ['name', 'value'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        \Core\core::getInstance()->getDB()->update('price', $RowFilter, ['id' => $id]);
        return true;
    }

    public function deletePrice($id)
    {
        $info = $this->getPriceById($id);
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if (empty($info) || empty($user) || $user['access'] != 1)
            return false;
        \Core\core::getInstance()->getDB()->delete('price', ['id' => $id]);
        return true;
    }


}