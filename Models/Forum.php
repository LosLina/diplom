<?php

namespace Models;


use Core\Utils;
use Imagick;

class Forum extends \Core\Model
{


    public function AddForum($newsRow)
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
        $fields = ['text', 'title'];
        $RowFilter = Utils::ArrFilter($newsRow, $fields);
        $RowFilter['datetime'] = date('Y-m-d H:i:s');//2021-01-13 18:00:00
        $RowFilter['user_id'] = $user['id'];
        $id = \Core\core::getInstance()->getDB()->insert('forum', $RowFilter);
        return [
            'error' => false,
            'id' => $id
        ];
    }

    public function Validate($newsRow)
    {
        $errors = [];
        if (empty($newsRow['text']))
            $errors[] = 'Поле "Текст" не може бути порожнім!';
        if (empty($newsRow['title']))
            $errors[] = 'Поле "Заголовок" не може бути порожнім!';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function getLastNews($count)
    {
        return \Core\core::getInstance()->getDB()->select('forum', '*', null, ['datetime' => 'ASC'], $count);

    }

    public function getNewsById($id)
    {
        $forum = \Core\core::getInstance()->getDB()->select('forum', '*', ['id' => $id]);
        if (!empty($forum))
            return $forum[0];
        else
            return null;
    }

    public function updateForum($row, $id)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null)
            return false;
        $valRez = ($this->Validate($row));
        if (is_array($valRez))
            return $valRez;
        $fields = ['text', 'title'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        \Core\core::getInstance()->getDB()->update('forum', $RowFilter, ['id' => $id]);
        return true;
    }

    public function deleteForum($id)
    {
        $news = $this->getNewsById($id);
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if (empty($news) || empty($user) || $user['access'] != 1)
            if ($user['id'] != $news['user_id'])
                return false;
        \Core\core::getInstance()->getDB()->delete('forum', ['id' => $id]);
        return true;


    }
}
