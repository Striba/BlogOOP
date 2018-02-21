<?php  
class Router 
	
	{
            //Создаем защещенную переменную для массива внутренних роутов-путей:
            private $routes;
            //Создаем конструктор определяющий принимаемые аргументы:
            public function __construct()
            {
                $routesPath = ROOT.'/config/routes.php';
                //Подключаем файл с массивом роутов и передаем в
                // зарезервированную приватную переменную:
                $this->routes = include($routesPath);
            }

            /**
             * Ф-я получения пути URI:
             */
            private function getURI()
            {
                //Проверка на наличие URI в глобальном массиве $_SERVER
                if (!empty($_SERVER['REQUEST_URI'])) 
                {
                    //Удаляем '/' с начала и конца полученного URI 
                    return trim($_SERVER['REQUEST_URI'], '/');
                }
            }

            public function run()
            {
                    // Получаем строку запроса
                    $uri = $this->getURI();
                    
                // Проверить наличие такого запроса в routes.php
                foreach ($this->routes as $uriPattern => $path) {
                    if(preg_match("~^$uriPattern$~", $uri)) {
                                
                        // Получаем внутренний путь из внешнего согласно правилу.
                        $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                        //Рзделяем полученный внутренний путь на сегменты:
                        $segments = explode('/', $internalRoute);

                        //Выбераем первый элемент полученного массива, 
                        //и создаем динамическое имя соответсвующего контроллера:
                        $controllerName = array_shift($segments).'Controller';
                        //Переводим в верхний регистр начало название контроллера,
                        // чтобы совпадение получить с одноименным 
                        // название файла контроллера
                        $controllerName = ucfirst($controllerName);

                        //Аналогичным образом формируем диначическое название метода, 
                        //вызываемого в текущем контроллере:
                        $actionName = 'action'.ucfirst((array_shift($segments)));

                        //Получаем требуемые аргумены для передачи в вызываемый метод:
                        $parameters = $segments; 
                        //Подключаем вызываемый контроллер, если такой имеется в наличии:
                        $controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
                        if (file_exists($controllerFile)) {
                                include_once($controllerFile);
                        }
                        
                        //Создаем объект вызывемого контроллера: 
                        $controllerObject = new $controllerName;
                        //Вызываем метод $controllerObject->$actionName() с $parameters аргументами:
                        $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                        if ($result != null) {
                                break;
                        }
                    }
                }
            }

	}

