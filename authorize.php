<?php
header('Content-type: application/json');
require_once "Authorize_class.php";
require_once "Register_class.php";

$method = $_SERVER['REQUEST_METHOD'];
session_start();
$_SESSION['token'] = null;

if($method==="POST")
{

    $auth = new authorizePOST($_POST);  //создаю экземпляр класса, для которого в Authorize_class.php определены методы
    $check = new registerPOST($_POST);

    $res = $check->check_email(); // результат метода проверки на существования email в БД
    $hash = null;

    //если email существует, тогда получаю хеш
    if($res['res'] > 0)
    {
        $hash = $auth->get_hash(); //получаю хеш пароля
    }
    else
    {
        http_response_code(400);
        echo "Неверный email";
    }


    if($hash != null)
    {
    //если вводимый пароль соответствует хешу, тогда верификация прошла успешно, формируем токен
    if (password_verify($_POST['password'], $hash['password'])) {

        http_response_code(200);
        $data = $auth->get_user($hash['password']); //получаю data от user, чтоб передать через параметр методу получения токена
        $token = $auth->get_token($data);
        echo $token;

        $_SESSION['token'] = $token; //устанавливаю $token в ключ сессии

       } else {

       http_response_code(400);
       echo 'Неверный пароль';

       }
    }

}
else
{
    http_response_code(400);
    echo "Необрабатываемый request метод";
}


?>