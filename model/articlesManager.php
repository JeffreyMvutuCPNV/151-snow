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
