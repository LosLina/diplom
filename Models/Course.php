<?php

namespace Models;

use Core\Utils;

class Course extends \Core\Model
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
        $fields = ['name', 'text'];
        $RowFilter = Utils::ArrFilter($newsRow, $fields);
        $RowFilter['datetime'] = date('Y-m-d H:i:s');//2021-01-13 18:00:00

        $id = \Core\core::getInstance()->getDB()->insert('opros', $RowFilter);
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
        if (empty($newsRow['text']))
            $errors[] = 'Поле "Текст" не може бути порожнім!';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function getLastOpros($count)
    {
        return \Core\core::getInstance()->getDB()->select('opros', '*', null, ['datetime' => 'ASC'], $count);

    }

    public function getOprosById($id)
    {
        $forum = \Core\core::getInstance()->getDB()->select('opros', '*', ['id' => $id]);
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
        $valRez = ($this->Validate($row));
        if (is_array($valRez))
            return $valRez;
        $fields = ['name', 'text', 'status'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        \Core\core::getInstance()->getDB()->update('opros', $RowFilter, ['id' => $id]);
        return true;
    }

    public function delete($id)
    {
        $news = $this->getOprosById($id);
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if (empty($news) || empty($user) || $user['access'] != 1)
                return false;
        \Core\core::getInstance()->getDB()->delete('opros', ['id' => $id]);
        return true;

    }


}