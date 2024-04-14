<?php

namespace Core;

use http\Client\Request;

/**
 * головний клас ядра системи
 */
class core
{
    private static $instance;
    private static $mainTemplate;
    private static $db;

    private function __construct()
    {
        global $Config;
        spl_autoload_register('\Core\core::__autoload');
        self::$db = new \Core\DB($Config['Database']['Server'],
            $Config['Database']['Username'],
            $Config['Database']['Password'],
            $Config['Database']['Database']);
    }

    /**
     * повертає екземпляр ядра системи
     * @return core
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new core();
            return self::getInstance();
        } else
            return self::$instance;
    }

    /**
     * отримання об'єкт - з'єднання з базою данних
     * @return DB
     */
    public function getDB()
    {
        return self::$db;
    }

    /**
     *  ініціалізація системи
     */
    public function init()
    {
        session_start();
        self::$mainTemplate = new Template();
    }

    /**
     * виконує основний процес роботи системи cms
     */
    public function run()
    {
        $path = $_GET['path'];
        $pathParts = explode('/', $path);
        $className = ucfirst($pathParts[0]);
        if (empty($className))
            $fullClassName = 'Controllers\\Site';
        else
            $fullClassName = 'Controllers\\' . $className;
        $methodName = ucfirst($pathParts[1]);
        if (empty($methodName))
            $fullMethodName = 'actionIndex';
        else
            $fullMethodName = 'action' . $methodName;

        if (class_exists($fullClassName)) {
            $controller = new $fullClassName();
            if (method_exists($controller, $fullMethodName)) {
                $method = new \ReflectionMethod($fullClassName, $fullMethodName);
                $paramArray = [];
                foreach ($method->getParameters() as $parameter) {
                    array_push($paramArray, isset($_GET[$parameter->name]) ? $_GET[$parameter->name] : null);
                }
                $rez = $method->invokeArgs($controller, $paramArray);
                if (is_array($rez)) {
                    self::$mainTemplate->setParams($rez);
                }
            } else
                header('Location: http://course-project22/errors.php');
        } else
            header('Location:http://course-project22/errors.php');

    }

    /**
     * завершує роботу системи та виведення результату
     */
    public function done()
    {
        self::$mainTemplate->display('Views/layout/index.php');
    }

    /**
     * автозавант класів
     * @param $className string назва класу
     */
    public static function __autoload($className)
    {
        $fileName = $className . '.php';
        if (is_file($fileName))
            include($fileName);
    }
}