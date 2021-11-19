<?php

/**
 * @file      userMgt.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.11.16
 * @date      16.11.2021
 */

function checkLogin($email, $pwd) : bool {
    // read the JSON of users or the database
    // if the credentials match
        // then logged. say yes
    //otherwise, not logged. Say false

    $fex = file_exists("users.json");
    $content = file_get_contents("users.json");
    if ($content) {
        $data = json_decode($content, true);
        $credentials = isset($data["logins"]);


        foreach ($data as $cred) {
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
 