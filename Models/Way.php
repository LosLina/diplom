<?php

namespace Models;

use Core\Utils;

class Way extends \Core\Model
{
    public function AddWay($newsRow)
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
        $valRez = ($this->ValidateWay($newsRow));
        if (is_array($valRez)) {
            $rez = [
                'error' => true,
                'messages' => $valRez
            ];
            return $rez;
        }
        $fields = ['name'];
        $RowFilter = Utils::ArrFilter($newsRow, $fields);;
        $id = \Core\core::getInstance()->getDB()->insert('way', $RowFilter);
        return [
            'error' => false,
            'id' => $id
        ];
    }

    public function ValidateWay($infoRow)
    {
        $errors = [];
        if (empty($infoRow['name']))
            $errors[] = 'Поле "Назва" не може бути порожнім!';

        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function getLastNewsWay($count)
    {
        return \Core\core::getInstance()->getDB()->select('way', '*', null, ['id' => 'ASC'], $count);

    }

    public function getNewsWayById($id)
    {
        $info = \Core\core::getInstance()->getDB()->select('way', '*', ['id' => $id]);
        if (!empty($info))
            return $info[0];
        else
            return null;
    }
    public function update($row, $id)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null)
            return false;
        $valRez = ($this->ValidateWay($row));
        if (is_array($valRez))
            return $valRez;
        $fields = ['name'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        \Core\core::getInstance()->getDB()->update('way', $RowFilter, ['id' => $id]);
        return true;
    }

    public function delete($id)
    {
        $info = $this->getNewsWayById($id);
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if (empty($info) || empty($user) || $user['access'] != 1)
            return false;
        \Core\core::getInstance()->getDB()->delete('way', ['id' => $id]);
        return true;
    }


}