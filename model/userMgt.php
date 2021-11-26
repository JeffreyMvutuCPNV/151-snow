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
    // read the JSON of users or the database
    // if the credentials match
        // then logged. say yes
    //otherwise, not logged. Say false

    $queryString = "SELECT userEmailAddress, userHashPsw FROM snows.users WHERE userEmailAddress = :femail AND userHashPsw = :fpass ;";
    $res = executeQuerySelect($queryString, array(":femail" => $email, ":fpass" => $pwd));

//    $queryString = "SELECT userEmailAddress, userHashPsw FROM snows.users WHERE userEmailAddress = :femail ;";
//    $res = executeQuerySelect($queryString, array( ":femail" => "pba@cpnv.ch" ));
    // echo "result: ". $res[0]["userEmailAddress"];

    if ($res) {
        $entry = $res[0];
        if ($email == $entry["userEmailAddress"] && $pwd == $entry["userHashPsw"]) {
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
