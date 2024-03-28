<?php

header('Content-type: application/json');
require_once "Register_class.php";

$method = $_SERVER['REQUEST_METHOD']; //суперглобальная переменная $_SERVER, содержит в себе текующий request метод 

session_start();
$_SESSION['token'] = null; //поскольку этап регистрации, поэтому токена нет

if($method==="POST")
{

    $check = new registerPOST($_POST); //создаю экземпляр класса, передаю в конструктор суперглобальную переменную $_POST

    $res_valid = $check->check_valid_email(); // результат метода проверки email на валидацию
    $res = $check->check_email(); // результат метода проверки на существования email в БД
    $res_pass = $check->check_password(); // результат метода проверки пароля на надёжность


    if($res_valid === "Email корректный" && $res['res'] == 0 && ($res_pass === "good" || $res_pass === "perfect")) //если email валидный, не содержится в БД, пароль надёжный - добавляем в БД
    {
        $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT); //формирую хеш пароля
        $check->dataPOST($pass_hash , $res_pass); //вызываю метод для добавления хеш в БД

        //после добавления формируем ответ
        http_response_code(201);
        echo $check->answer();
    }
    else
    {
        http_response_code(400);
        echo $check->bad_ans($res_valid , $res['res']);

        if($res_pass === "weak_password\n")
            echo $res_pass;
    }
    
}
else
{
    http_response_code(400);
    echo "Необрабатываемый request метод";
}

?>