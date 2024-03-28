<?php

require_once "connect.php";
require __DIR__ . '/vendor/autoload.php';

class authorizePOST
{
    private PDO $obj;
    private array $data = [];
    public function __construct($data)
    {
        $con = new connectPDO();
        $this->obj = $con->get_obj();
        $this->data = $data;
    }


    //метод на получения хеша, соответствующему email
    public function get_hash(): array
    {
        $hash_res = $this->obj->prepare("SELECT `password` FROM `User` WHERE `email` = :email;");
        $hash_res->execute([
            ':email' => $this->data['email']
        ]);

        $res = $hash_res->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //метод на получение user
    public function get_user($hash): array
    {
        $sql = $this->obj->prepare("SELECT * FROM `User` WHERE `email` = :email AND `password` = :password;");
        $sql->execute([
        ':email' => $this->data['email'],
        ':password' => $hash
        ]);

        $res = $sql->fetch(PDO::FETCH_ASSOC);
        return $res;
    }


    //метод на формирование и возвращение токена
    public function get_token($data): string
    {
        //данные об user_id заношу в ассоциативный массив
        $load_data = [
            "user_id" => $data['id'],
            "email" => $data['email'],
            "password" => $data['password'],
            "pass_status" => $data['pass_status']
        ];
        
        // Установка срока действия токена
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // 1 час
        
        // Формирование токена
        $token = array(
            "iat" => $issuedAt, // Время выдачи токена
            "exp" => $expirationTime, // Время истечения срока действия токена
            "data" => $load_data // data user_id
        );
        

        $secret_key = $this->get_secret_key();
        $jwt = \Firebase\JWT\JWT::encode($token, $secret_key , "HS256"); //генерирую токен, подписываю его и шифрую алгоритмом HS256
        
        return json_encode(array("access_token" => $jwt) , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); //возвращаю json
    }

    //формирую секртеный ключ
    private function get_secret_key(): string
    {
        //ключ для подписи токена
        $bytes = random_bytes(32); 
        $secret_key = base64_encode($bytes); 
        return $secret_key; 
    }

}

?>