<?php

namespace Models;

use Core\Utils;

class Note extends \Core\Model
{
    public function Add($newsRow)
    {
        $valRez = ($this->Validate($newsRow));
        if (is_array($valRez)) {
            $rez = [
                'error' => true,
                'messages' => $valRez
            ];
            return $rez;
        }
        $fields = ['name', 'phone','service'];
        $RowFilter = Utils::ArrFilter($newsRow, $fields);
        $RowFilter['datetime'] = date('Y-m-d H:i:s');//2021-01-13 18:00:00

        $id = \Core\core::getInstance()->getDB()->insert('note', $RowFilter);
        return [
            'error' => false,
            'id' => $id
        ];
    }
    public function Validate($newsRow)
    {
        $errors = [];
        if (empty($newsRow['name']))
            $errors[] = 'Поле "Ім\'я" не може бути порожнім!';
        if (empty($newsRow['phone']))
            $errors[] = 'Поле "Номер телефону" не може бути порожнім!';
        if (empty($newsRow['service']))
            $errors[] = 'Поле "Послуга" не може бути порожнім!';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }
    public function getLastNote($count)
    {
        return \Core\core::getInstance()->getDB()->select('note', '*', null, ['datetime' => 'ASC'], $count);

    }

    public function getNoteById($id)
    {
        $forum = \Core\core::getInstance()->getDB()->select('note', '*', ['id' => $id]);
        if (!empty($forum))
            return $forum[0];
        else
            return null;
    }

    public function update($row, $id)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null)
            return false;
        $fields = ['name', 'phone', 'service', 'status'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        \Core\core::getInstance()->getDB()->update('note', $RowFilter, ['id' => $id]);
        return true;
    }

    public function delete($id)
    {
        $news = $this->getNoteById($id);
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if (empty($news) || empty($user) || $user['access'] != 1)
            return false;
        \Core\core::getInstance()->getDB()->delete('note', ['id' => $id]);
        return true;

    }
}