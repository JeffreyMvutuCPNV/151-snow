<?php

/**
 * @file      users.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.11.16
 * @date      16.11.2021
 */

require_once "model/userMgt.php";

/**
 * @brief This function is designed to redirect the user to the login page (depending on the action received by the index)
 */
function login($data)
{
    if ($_SESSION["email"] ?? null) {
        require "view/home.php";
        return;
    }

    $email = $data["email"] ?? null;
    $pwd = $data["userPswd"] ?? null;

    // coming from the login page (with authentication credentials)
    if (isset($email)) {
        $credentialsComplete = false;
        if (isset($pwd)) {
            $credentialsComplete = true;
        }

        if ($credentialsComplete) {
            $email = sanitize_db_input($email);
            $pwd = sanitize_db_input($pwd);

            $credentialsMatch = $credentialsComplete ? checkLogin($email, $pwd) : false;
            if ($credentialsMatch) {
                $_SESSION["logged"] = true;
                $_SESSION["email"] = $email;
                require "view/home.php";
            } else {
                $loginError = true;
                $loginErrorMsg = "L'email ou le mot de passe est incorrect.";
                require "view/login.php";
            }
            return;
        } else {
            // TODO : show error message because user has not entered all the informations
            $loginError = true;
            $loginErrorMsg = "Vous devez spécifier l'email et le mot de passe.";

            require "view/login.php";
        }
    } else {
        require "view/login.php";
    }
}

function signup($data){
    // check passwords match
    // save to DB
    $error = false;
    $errorMessages = array();

    $email = $data["email"] ?? "";
    $password = $data["userPswd"] ?? "";
    $passwordVerif = $data["userPswdVerify"] ?? "";

    $equal = strcmp($password, $passwordVerif);
    if ($equal!==0 || !isStrongPassword($password)) {
        $error = true;
        array_push($errorMessages, "Les mots de passe de concordent pas.");
    }

    // email regex according to: https://html.spec.whatwg.org/multipage/input.html#valid-e-mail-address
    // /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/
    $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";
    $emailOk = preg_match($pattern, $email);

    if (!$emailOk) {
        $error = true;
        array_push($errorMessages, "Ce n'est pas une adresse email valide.");
    }

    if (!$error) {
        // quelle erreur retourner ?
        $addedUser = registerNewUser($email, $password);
        if ($addedUser) {
//            http_redirect("/index.php");
//            header("Location: /index.php", true, 301);
            login(array("email" => $email, "userPwd" => $password));
        } else {
            $msg = 'Un utilisateur est déjà enregistré avec ce nom. Voulez-vous vous <a href="/index.php?action=login">connecter</a> ?';
            array_push($errorMessages, $msg);
            $error = true;
        }
    }
    require 'view/signup.php';
}

function isStrongPassword($passwd): bool {
    return $passwd !=null && strlen($passwd) >= 3;
}

function logout() {
    session_destroy(); //< takes a refresh before being active. It sends the cookie.

    // Ensure the logout happens immediately.
    /*
    unset($_SESSION["logged"]);
    unset($_SESSION["email"]);
    */
    $_SESSION = array();

    // redirect the url
    // source: https://www.tutorialrepublic.com/faq/how-to-make-a-redirect-in-php.php
    // source: https://code.tutsplus.com/tutorials/how-to-redirect-with-php--cms-34680
    header("Location: /index.php", true, 301);

    require "view/home.php";
}
