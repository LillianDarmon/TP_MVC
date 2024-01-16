<?php
class User extends Database
{
    //Attribut
    public $email;
    public $createdAt;
    public $role;
    public $pass;

    public $token;

    /**
     * Method construct qui ce connecte a ma base de données
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Method qui permet de recuperer les infos d'un user via son mail
     */
    public function getUserMail()
    {
        $query = 'SELECT * FROM `ajax_user` WHERE `email`=:email;';
        $fetchProfil = $this->db->prepare($query);
        $fetchProfil->bindValue(':email', $this->email, PDO::PARAM_STR);
        $fetchProfil->execute();
        return $fetchProfil->fetch(PDO::FETCH_OBJ);
    }

    public function insertUser()
    {
        $query = 'INSERT INTO `ajax_user` (`email`, `pass`, `role`) VALUES (:email, :pass, :admin)';
        $fetchProfil = $this->db->prepare($query);
        $fetchProfil->bindParam(":email", $this->email, PDO::PARAM_STR);
        $fetchProfil->bindParam(":pass", $this->pass, PDO::PARAM_STR);
        $fetchProfil->bindParam(":admin", $this->role, PDO::PARAM_STR);
        return $fetchProfil->execute();
    }
    public function generateCsrfToken()
    {
        $csrf_token = bin2hex(random_bytes(32));
        $this->token = $csrf_token;
        $query = 'UPDATE `ajax_user` SET `csrf_token` = :csrf_token WHERE `email` = :email';
        $fetchProfil = $this->db->prepare($query);
        $fetchProfil->bindParam(":email", $this->email, PDO::PARAM_STR);
        $fetchProfil->bindParam(":csrf_token", $this->token, PDO::PARAM_STR);
       return $fetchProfil->execute();
    }
    public function regenerateCsrfToken()
    {
        $this->token = $this->generateCsrfToken();
        return $this->token;
    }
}
