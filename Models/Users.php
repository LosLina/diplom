<?php

namespace Models;

use Core\Model;
use Core\Utils;
use Imagick;

class Users extends Model
{

    public function getUserById($id)
    {
        $user = \Core\core::getInstance()->getDB()->select('users', '*', ['id' => $id]);
        if (!empty($user))
            return $user[0];
        else
            return null;
    }

    public function changePhoto($id, $file)
    {
        $folder = 'Files/Users/';
        $file_path = pathinfo($folder . $file);
        $file_small = $file_path['filename'] . '_s';
        $phus = $this->getUserById($id);
        if (is_file($folder . $phus['photo_user'] . '_s.jpg') && is_file($folder . $file))
            unlink($folder . $phus['photo_user'] . '_s.jpg');//при оновленні буде видалено старe
        $phus['photo_user'] = $file_path['filename'];
        $im_s = new Imagick();
        $im_s->readImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . $file);
        $im_s->cropThumbnailImage(200, 245, true);
        $im_s->writeImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . '/' . $file_small . '.jpg');
        unlink($folder . $file);
        $this->updateUser($phus, $id);
    }

    public function Validate($formRow)
    {
        $errors = [];
        if (empty($formRow['login']))
            $errors[] = 'Поле "Логін" не може бути порожнім!';
        $user = $this->GetUserByLogin($formRow['login']);
        if (!empty($user))
            $errors[] = 'Користувач із вказаним логіном вже зареєстрований!';
        if (empty($formRow['password']))
            $errors[] = 'Поле "Пароль" не може бути порожнім!';
        if ($formRow['password'] != $formRow['password2'])
            $errors[] = 'Паролі не співпадають!';
        if (strlen($formRow['password']) <= 5)
            $errors[] = 'Поле "Пароль" має містити більше 5-ьох символів!';

        if (empty($formRow['firstname']))
            $errors[] = 'Поле "Прізвище" не може бути порожнім!';
        if (strlen($formRow['firstname']) <= 3)
            $errors[] = 'Поле "Прізвище" має містити більше 3-ьох символів!';
        if (is_numeric($formRow['experience']))
            $errors[] = 'Поле "Прізвище" немає містити цифри!';

        if (empty($formRow['lastname']))
            $errors[] = 'Поле "Ім\'я" не може бути порожнім!';
        if (is_numeric($formRow['experience']))
            $errors[] = 'Поле "Ім\'я" немає містити цифри!';


        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function AddUser($userRow)
    {
        $valRez = ($this->Validate($userRow));
        if (is_array($valRez)) {
            $rez = [
                'error' => true,
                'messages' => $valRez
            ];
            return $rez;
        }
        $fields = ['login', 'password', 'lastname', 'firstname'];
        $userRowFilter = Utils::ArrFilter($userRow, $fields);
//        $userRowFilter['photo_user'] = '...photo';
        $userRowFilter['password'] = md5($userRowFilter['password']);
        $id = \Core\core::getInstance()->getDB()->insert('users', $userRowFilter);
        return [
            'error' => false,
            'id' => $id
        ];
    }

    public function IsUserAut()
    {
        return isset($_SESSION['user']);
    }

    public function getCurrentUser()
    {
        if ($this->IsUserAut())
            return $_SESSION['user'];
        else
            return null;

    }

    public function updateUser($row, $id)
    {
        $fields = ['login', 'password', 'lastname', 'firstname', 'photo_user'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        \Core\core::getInstance()->getDB()->update('users', $RowFilter, ['id' => $id]);
        return true;

    }

    public function AuthUser($login, $password)
    {
        $password = md5($password);
        $users = \Core\core::getInstance()->getDB()->select('users', '*', [
            'login' => $login,
            'password' => $password
        ]);
        if (count($users) == 1) {
            $user = $users[0];
            return $user;
        } else
            return false;
    }

    public function GetUserByLogin($login)
    {
        $rows = \Core\core::getInstance()->getDB()->select('users', '*', ['login' => $login]);
        if (count($rows) > 0)
            return $rows[0];
        else
            return null;
    }


    public function ValidateP($formRow)
    {
        $errors = [];
        if (empty($formRow['password']))
            $errors[] = 'Поле "Новий пароль" не може бути порожнім!';
        if (strlen($formRow['password']) <= 3)
            $errors[] = 'Поле "Пароль" має містити більше 3-ьох символів!';
        if ($formRow['password'] != $formRow['passwordnew2'])
            $errors[] = 'Паролі не співпадають!';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }


    public function updateUser2($row, $id)
    {
        $userModel = new \Models\Users();
        $user = $userModel->getCurrentUser();
        if ($user == null)
            return false;
        $valRez = ($this->ValidateP($row));
        if (is_array($valRez))
            return $valRez;
        $fields = ['login', 'password', 'lastname', 'firstname', 'photo_user'];
        $RowFilter = Utils::ArrFilter($row, $fields);
        $RowFilter['password'] = md5($RowFilter['password']);
        \Core\core::getInstance()->getDB()->update('users', $RowFilter, ['id' => $id]);
        return true;

    }

    public function deleteUser($id)
    {
        \Core\core::getInstance()->getDB()->delete('users', ['id' => $id]);
        return true;
    }

}