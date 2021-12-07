<?php

/**
 * @file      userMgt.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.11.16
 * @date      16.11.2021
 */


require_once "utils/utils.php";
require_once "model/dbConnector.php";

function checkLogin($email, $pwd) : bool {
    // check the credentials
    // and check the result

    $queryString = "SELECT userEmailAddress, userHashPsw FROM snows.users WHERE userEmailAddress = :femail;";
    $res = executeQuerySelect($queryString, array(":femail" => $email));

    if ($res && count($res) == 1) {
        $entry = $res[0];
        $hash = $entry["userHashPsw"];
        if (password_verify($pwd, $hash)) {
            return true;
        }
    }
    return false;
}

function checkLoginFromFile($email, $pwd) : bool {
    // read the JSON of users or the database
    // if the credentials match
    // then logged. say yes
    //otherwise, not logged. Say false
    $filepath = "C:/Courses/ict-151-php/users.json";
//    $filepath = "model/users.json";

    $content = file_get_contents($filepath);
    if ($content) {
        $data = json_decode($content, true);
        $credentials = $data["logins"] ?? array();

        foreach ($credentials as $cred) {
            $login = $cred["login"];
            $pass = $cred["pwd"];
            if ($email == $login) {
                if ($pwd == $pass)
                    return true;
            }
        }
    }
    return false;
}

function registerNewUser($email, $pwd): bool {
    // sanitize here if needed ?
    // model should be the one to ensure its own sanitization mechanism, right ?
    $validEmail = $email;

    // already a user
    $queryString = "SELECT userEmailAddress FROM snows.users WHERE userEmailAddress = :femail LIMIT 1;";
    $res = executeQuerySelect($queryString, array(":femail" => $validEmail));

    // user not created because another user already exists
    if ($res && count($res) > 0) {
        return false;
    }


    $hashed = password_hash($pwd, PASSWORD_DEFAULT);
    $query = "INSERT INTO snows.users (userEmailAddress, userHashPsw) VALUES ('". $validEmail . "', '". $hashed ."');";
    executeQueryInsert($query);
    return true;
}
