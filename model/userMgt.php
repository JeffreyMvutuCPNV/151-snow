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


function checkLogin($email, $pwd) : bool {
    // read the JSON of users or the database
    // if the credentials match
        // then logged. say yes
    //otherwise, not logged. Say false
    $filepath = "model/users.json";

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
        return false;
    } else {
        return false;
    }
    /*$fh = fopen("users.json");
    if (reading ok) {
    }
    fclose($fh);
    */
}

