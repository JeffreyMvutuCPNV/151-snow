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
function login()
{
    $data = $_POST;
    $email = $data["email"];
    $pwd = $data["userPswd"];

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
                require "view/login.php";
            }
            return;
        } else {
            // TODO : show error message because user has not entered all the informations
            $loginError = true;

            require "view/login.php";
        }
    } else {
        require "view/login.php";
    }
}
