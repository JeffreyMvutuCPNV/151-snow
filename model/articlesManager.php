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
    $query = "SELECT code,brand,model,price,snowLength,description,descriptionFull,'level',photo FROM snows.snows WHERE code = :artcode";
    $params = array(":artcode" => $code);
    $result = executeQuerySelect($query, $params);
    $prod = count($result) >= 1 ? $result[0]:null;
    return $prod;
}

function getArticlesFromStorage(int $perPage=0, int $pageNbr=1): array {
//    $perPage = ($perPage && $perPage >= 1) ? $perPage : 12;
    $pageNbr = ($pageNbr && $pageNbr >= 1) ? $pageNbr : 1;
    $offset = ($pageNbr - 1) * $perPage;

    if (!$perPage || $perPage < 1) {
        $query = "SELECT * FROM snows.snows";
        $params = array();
    } else {
        $query = "SELECT * FROM snows.snows LIMIT :perPage OFFSET :theOffset";
        $params = array(":perPage" => $perPage, ":theOffset" => $offset);
    }

    return executeQuerySelect($query, $params);
}

function getArticlesCount(): int {
    return executeQuerySelect("SELECT count(id) as nb FROM snows.snows", array())[0]["nb"];
}

function addNewArticle(array $data): bool {
    $query = "INSERT INTO snows.snows (code,brand,model,snowLength) VALUES (:fcode , :fbrand , :fmodel , :flength,)";



    // TODO : update
    return false;
}

function _checkHasRequiredArticleFields(array $values, array $expectedKeys): bool {
    foreach ($expectedKeys as $key) {
        if (!array_key_exists($key, $values))
            return false;
    }
    return true;
}
