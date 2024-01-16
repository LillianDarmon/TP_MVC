<?php
include "../model/config.php";
include "../model/database.php";
include "../model/user.php";
if (isset($_POST['login']) && !empty($_POST['login'])) {
    $login = htmlspecialchars($_POST['login']);
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        $passHash = password_hash($password, PASSWORD_BCRYPT);
    }
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
      
        session_start();
        $response['type'] = 'Success';
        $response['data'] = 'Vous allez être redirigé';
        $response['url'] = 'index.php';
     
        $getUser = new User();
        $getUser->email = $login;
        $getUser->pass = $passHash;
        $getUser->role = "admin";
      
        
      
        try {
            $getUser->insertUser();
            $getUser->generateCsrfToken();
            if (password_verify($password, $getUser->pass)) {
                $user = $getUser->getUserMail();
                if (is_object($user)) {
                    if (password_verify($password, $user->pass)) {
                        $_SESSION['email'] = $user->email;
                        $_SESSION['id'] = $user->id;
                        $_SESSION['role'] = $user->role;
                        $_SESSION['csrf_token'] = $user->csrf_token;
                        $response['url'] = 'index.php?id=' . $_SESSION['id'] . '&role=' . $_SESSION['role'] . '&csrf_token=' . $_SESSION['csrf_token'];
                        $response['type'] = 'Success';
                        $response['data'] = 'Vous allez être redirigé';
                        echo json_encode($response);
                    }
                } else {
                    $response['type'] = 'Success';
                    $response['data'] = 'Aucun utilisateur n\'existe';
                    echo json_encode($response);
                }
            }
        }catch(Exception $e){
            echo "An error occurred: " . $e->getMessage();
        }

    } else {
        $response['type'] = "ERROR";
        $response['data'] = 'Une erreur c\'est produite';
        echo json_encode($response);
    }
}
