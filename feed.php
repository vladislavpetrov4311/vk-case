<?php
session_start();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method){
    case "GET":
        
        //если токен не пустой
        if(isset($_SESSION['token']))
        {
            http_response_code(200);
            echo "Доступ разрешён";
        }
        else
        {
            http_response_code(401);
            echo "Доступ запрещён";
        }

        break;

    default:
        http_response_code(400);
        echo "необрабатываемый request метод";
}


?>