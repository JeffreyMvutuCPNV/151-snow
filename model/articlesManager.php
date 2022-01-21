<?php

/**
 * @file      articlesManager.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.11.30
 * @date      30.11.2021
 */

require_once "model/dbConnector.php";

function getArticleFromStorage(string $code) {
    // avoid the * form because a someone maintaining the view might get confused if
    // they use integer access for some reason (instead of keys)
    // $query = "SELECT * FROM snows.snows WHERE code = :artcode";
//    $query = "SELECT code,brand,model,price,snowLength,description,descriptionFull,'level',photo FROM snows.snows WHERE code = :artcode";
    $query = "SELECT code,brand,model,price,snowLength,description,descriptionFull,'level',photo FROM snows.snows WHERE code = :artcode AND deleted=0";
    $params = array(":artcode" => $code);
    $result = executeQuerySelect($query, $params);
    $prod = count($result) >= 1 ? $result[0] : null;
    return $prod;
}

function getArticlesFromStorage(int $perPage=0, int $pageNbr=1): array {
//    $perPage = ($perPage && $perPage >= 1) ? $perPage : 12;
    $pageNbr = ($pageNbr && $pageNbr >= 1) ? $pageNbr : 1;
    $offset = ($pageNbr - 1) * $perPage;

    if (!$perPage || $perPage < 1) {
//        $query = "SELECT * FROM snows.snows";
        $query = "SELECT * FROM snows.snows WHERE deleted = 0";
        $params = array();
    } else {
//        $query = "SELECT * FROM snows.snows LIMIT :perPage OFFSET :theOffset";
        $query = "SELECT * FROM snows.snows LIMIT :perPage OFFSET :theOffset WHERE deleted = 0";
        $params = array(":perPage" => $perPage, ":theOffset" => $offset);
    }

    return executeQuerySelect($query, $params);
}

function getArticlesCount(): int {
    return executeQuerySelect("SELECT count(id) as nb FROM snows.snows WHERE deleted=0", array())[0]["nb"];
//    return executeQuerySelect("SELECT count(id) as nb FROM snows.snows", array())[0]["nb"];
}

function removeArticle($code): bool {
//    $query = "DELETE FROM snows.snows WHERE code = :fcode";
    $query = "UPDATE snows.snows SET deleted=1 WHERE code = :fcode";
    return executeNonQuery($query, array(":fcode" => $code));
}

function addNewArticle(array $data, string $imgpath): bool {
    // TODO : check whole function

    $query = ("INSERT INTO snows.snows".
        " (code,brand,model,snowLength, price, qtyAvailable, audience, description, descriptionFull, photo, active, deleted)".
        " VALUES (:code , :brand , :model , :snowlength , :price , :qtyAvailable , :audience, :description , :descriptionFull, :photo , 1, 0)");

    $data["photo"] = $imgpath;
    $res = executeQueryInsert($query, $data);

    return $res;
}

function _checkHasRequiredArticleFields(array $values, array $expectedKeys): bool {
    foreach ($expectedKeys as $key) {
        if (!array_key_exists($key, $values))
            return false;
    }
    return true;
}
