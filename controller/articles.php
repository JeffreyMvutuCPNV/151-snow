<?php

/**
 * @file      articles.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.11.30
 * @date      30.11.2021
 */

require_once "model/articlesManager.php";

/**
 * @brief This function is designed to redirect the user to the products page (depending on the action received by the index)
 */
function displayArticlesPage()
{
    $totalProductsCount = getArticlesCount();
    $productsList = getArticlesFromStorage(0, 0);

    require "view/articles.php";
}

function displayArticlesAdminPage()
{
    $totalProductsCount = getArticlesCount();
    $productsList = getArticlesFromStorage(0, 0);

    require "view/articles.php";
}

function displayArticleDetailPage(string $code)
{
    $product = getArticleFromStorage($code);
    if ($product) {
        require "view/article_detail.php";
        return;
    }
    // no product found: display 404
//    header("Location: http://www.yoursite.com/index.php?action=");
    header("Location: /index?action=404", true, 301);
    exit();
}
