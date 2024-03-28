<?php

require_once "connect.php";

class registerPOST
{
    private PDO $obj;
    private array $data = [];
    public function __construct($data)
    {
        $con = new connectPDO();
        $this->obj = $con->get_obj();
        $this->data = $data;
    }



    //метод для получения значения о количества строк по данном фильтру
    public function check_email(): array
    {
        $sql = $this->obj->prepare("SELECT COUNT(`email`) AS `res` FROM `User` WHERE `email` = :email;");
        $sql->execute([
        ':email' => $this->data['email']
        ]);

        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return $res;
    }



    //метод для проверка email на валидацию
    public function check_valid_email(): string
    {
        $res;
        if (filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
            $res = "Email корректный";
        } else {
            $res = "Email некорректный";
        }

        return $res;
    }


    //метод для проверки надёжности пароля
    public function check_password(): string
    {
            $password = $this->data['password'];

            try{
            // Проверяем длину пароля
            if (strlen($password) < 8) {
                throw new Exception("weak_password\n");
            }
        
            // Проверяем, содержит ли пароль хотя бы одну цифру
            if (!preg_match('/\d/', $password)) {
                throw new Exception("weak_password\n");
            }
        
            // Проверяем, содержит ли пароль хотя бы одну букву верхнего регистра
            if (!preg_match('/[A-Z]/', $password)) {
                throw new Exception("weak_password\n");
            }
        
            // Проверяем, содержит ли пароль хотя бы одну букву нижнего регистра
            if (!preg_match('/[a-z]/', $password)) {
                throw new Exception("weak_password\n");
            }


            //дополнительная проверка пароля на наличие специального символа _
            if (!preg_match('/_/', $password)) {
                // Если все проверки пройдены, но нет символа _ , возвращаем "good"
                return "good";
            }
            else
            {
                return "perfect";
            }
        
            } catch(Exception $e)
            {
                return $e->getMessage();
            }

        }


    //метод для вставки в таблицу информацию об user при регистрации
    public function dataPOST($hash , $pass_status): void
    {
        $sql = $this->obj->prepare("INSERT INTO `User` (`email` , `password` , `pass_status`) VALUES (:email , :password , :pass_status);");
        $sql->execute([
        ':email' => $this->data['email'],
        ':password' => $hash,
        ':pass_status' => $pass_status
        ]);
    }    


    //метод для получения ответа после регистрации
    public function answer(): string
    {
        $sql = $this->obj->prepare("SELECT `id` , `pass_status` FROM `User` WHERE `email` = :email;");
        $sql->execute([
        ':email' => $this->data['email']
        ]);

        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }



    //метод, если что-то пошло не так
    public function bad_ans($e_val , $e_count): string
    {
        if($e_val != "Email корректный")
        {
            return "Email не корректный\n";
        }

        if($e_count != 0)
        {
            return "Такой email уже существует\n";
        }

        return "Email корректный\n";
    }


    }

?>