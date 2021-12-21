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

    require "view/articles_admin.php";
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

function displayArticleAddPage(?array $data=null, ?array $imageInfos=null) {
    if (!canAlterCatalog()){
        // not enough priviledges
        header("Location: /index?action=articles-admin", true, 301);
        return;
    }

    if ($data ?? false){
        // There is an article that has been added.
        // we will then redirect the user after saving the new product

        // save picture to temporary place : auto
        // register the article : ready
        // if registration successful, then move the file to the destination path.
        //    or just move it and if error, fix by hand. This is an admin

//        check image file size
//        check image dimensions
//        move image file to correct destination

        $success = addNewArticle($data);
        if ($success) {
            header("Location: /index?action=articles-admin", true, 301);
        } else {
            // TODO : show error messages
            $error = true;
            $errorMsg = "Certains champs requis sont absents.";
            require "view/article_add.php";
        }
    } else {
        // there is no article to add to the DB, so we display the
        require "view/article_add.php";
    }
}

function displayArticleEditPage(string $code) {
    echo "Page displayArticleEditPage under construction ";
}

function deleteArticle(string $code) {
    echo "Page deleteArticle under construction ";
//    require "view/articles_admin.php";
}

function canAlterCatalog(): bool {
    return ($_SESSION??array())["isAdmin"] ?? false;
}
