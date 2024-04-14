<?php

namespace Models;

use Core\Utils;
use Imagick;

class Info extends \Core\Model
{
    public function AddInfo($newsRow)
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
        $valRez = ($this->ValidateInfo($newsRow));
        if (is_array($valRez)) {
            $rez = [
                'error' => true,
                'messages' => $valRez
            ];
            return $rez;
        }
        $fields = ['title', 'phone', 'email', 'location'];
        $RowFilter = Utils::ArrFilter($newsRow, $fields);;
        $RowFilter['datetime'] = date('Y-m-d H:i:s');//2021-01-13 18:00:00
        $id = \Core\core::getInstance()->getDB()->insert('contacts', $RowFilter);
        return [
            'error' => false,
            'id' => $id
        ];
    }

    public function ValidateInfo($infoRow)
    {
        $errors = [];
        if (empty($infoRow['title']))
            $errors[] = 'Поле "Заголовок" не може бути порожнім!';
        if (empty($infoRow['email']))
            $errors[] = 'Поле "Електрона адреса" не може бути порожнім!';
        if (empty($infoRow['location']))
            $errors[] = 'Поле "Місцезнаходження" не може бути порожнім!';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function getLastNewsInfo($count)
    {
        return \Core\core::getInstance()->getDB()->select('contacts', '*', null, ['id' => 'ASC'], $count);

    }

    public function getNewsInfoById($id)
    {
        $info = \Core\core::getInstance()->getDB()->select('contacts', '*', ['id' => $id]);
        if (!empty($info))
            return $info[0];
        else
            return null;
    }

    public function updateNewsInfo($row, $id)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null)
            return false;
        $valRez = ($this->ValidateInfo($row));
        if (is_array($valRez))
            return $valRez;
        $fields = ['title', 'phone', 'email', 'location'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        \Core\core::getInstance()->getDB()->update('contacts', $RowFilter, ['id' => $id]);
        return true;
    }

    public function deleteNewsInfo($id)
    {
        $info = $this->getNewsInfoById($id);
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if (empty($info) || empty($user) || $user['access'] != 1)
            return false;
        \Core\core::getInstance()->getDB()->delete('contacts', ['id' => $id]);
        return true;
    }




}