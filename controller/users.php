<?php

/**
 * @file      users.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.11.16
 * @date      16.11.2021
 */


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
        if (!isset($pwd)) {
            $credentialsComplete = true;
        }

        require_once "model/userMgt.php";
        $credentialsMatch = $credentialsComplete ? checkLogin($email, $pwd) : false;

        if ($credentialsComplete) {
            if ($credentialsMatch) {
                $_SESSION["logged"] = true;
            }
            require "view/home.php";
            return;
        } else {
            // show error message because user has not entered all the informations
        }

        require "view/home.php";
    } else {
        require "view/login.php";
    }
}
