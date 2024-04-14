<?php

namespace Models;

use Core\Utils;
use Imagick;

class Blog extends \Core\Model
{
    public function AddNewsBlog($newsRow)
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
        $valRez = ($this->ValidateBlog($newsRow));
        if (is_array($valRez)) {
            $rez = [
                'error' => true,
                'messages' => $valRez
            ];
            return $rez;
        }
        $fields = ['title', 'text'];
        $RowFilter = Utils::ArrFilter($newsRow, $fields);
        $RowFilter['datetime'] = date('Y-m-d H:i:s');//2021-01-13 18:00:00
        $RowFilter['photo'] = '...photo';
        $id = \Core\core::getInstance()->getDB()->insert('blog', $RowFilter);
        return [
            'error' => false,
            'id' => $id
        ];
    }

    public function changePhotoBlog($id, $file)
    {
        $folder = 'Files/Blogs/';
        $file_path = pathinfo($folder . $file);
        $file_normal = $file_path['filename'] . '_n';
        $file_small = $file_path['filename'] . '_s';
        $blog = $this->getNewsBlogById($id);
        if (is_file($folder . $blog['photo'] . '_n.jpg') && is_file($folder . $file))
            unlink($folder . $blog['photo'] . '_n.jpg');
        if (is_file($folder . $blog['photo'] . '_s.jpg') && is_file($folder . $file))
            unlink($folder . $blog['photo'] . '_s.jpg');
        $blog['photo'] = $file_path['filename'];
        $im_n = new Imagick();
        $im_n->readImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . $file);
        $im_n->cropThumbnailImage(300, 200, true);
        $im_n->writeImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . '/' . $file_normal . '.jpg');


        $im_s = new Imagick();
        $im_s->readImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . $file);
        $im_s->cropThumbnailImage(180, 180, true);
        $im_s->writeImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . '/' . $file_small . '.jpg');
        unlink($folder . $file);
        $this->updateNewsBlog($blog, $id);
    }

    public function ValidateBlog($blogRow)
    {
        $errors = [];
        if (empty($blogRow['title']))
            $errors[] = 'Поле "Заголовок новини" не може бути порожнім!';
        if (empty($blogRow['text']))
            $errors[] = 'Поле "Текст" не може бути порожнім!';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function getLastNewsBlog($count, $offset)
    {
        return \Core\core::getInstance()->getDB()->select('blog', '*', null, ['datetime' => 'DESC'], $count, $offset);

    }
    public function getLastNewsBlog1($count)
    {
        return \Core\core::getInstance()->getDB()->select('blog', '*', null, ['datetime' => 'DESC'], $count);

    }


    public function getNewsBlogById($id)
    {
        $blog = \Core\core::getInstance()->getDB()->select('blog', '*', ['id' => $id]);
        if (!empty($blog))
            return $blog[0];
        else
            return null;
    }

    public function updateNewsBlog($row, $id)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null)
            return false;
        $valRez = ($this->ValidateBlog($row));
        if (is_array($valRez))
            return $valRez;
        $fields = ['title', 'text', 'photo'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        $RowFilter['lastedit'] = date('Y-m-d H:i:s');//2021-01-13 18:00:00
        \Core\core::getInstance()->getDB()->update('blog', $RowFilter, ['id' => $id]);
        return true;
    }

    public function deleteNewsBlog($id)
    {
        $blog = $this->getNewsBlogById($id);
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if (empty($blog) || empty($user))
            return false;
        \Core\core::getInstance()->getDB()->delete('blog', ['id' => $id]);
        return true;
    }
}