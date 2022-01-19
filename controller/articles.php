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
        // not enough priviledges -> redirect
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

//        check image file size < 1MB
//        check image dimensions
//        check image file type is png or jpeg/jpg
//        check field "Pour qui" has an accepted value
//        move image file to correct destination

        $success = imageIsFitting($imageInfos ?? false) && addNewArticle($data);
        if ($success) {
            header("Location: /index?action=articles-admin", true, 301);
        } else {
            // TODO : show error messages
            $error = true;
            $errorMsg = "Certains champs requis sont absents.";
            if ($imageInfos ?? false) {
                $errorMsg = "Il n'y a pas d'image, ou celle-ci ne correspond pas aux critères. Veuillez joindre une image de <1MB de type jpg ou png.";
            }
            require "view/article_add.php";
        }
    } else {
        // there is no article to add to the DB, so we display the
        require "view/article_add.php";
    }
}

function imageIsFitting(array $imageInfos, int $maxSize=-1) {
    // save picture to temporary place : auto

//        check image file size < 1MB
//        check image dimensions
//        check image file type is png or jpeg/jpg
//        check field "Pour qui" has an accepted value
//        move image file to correct destination


    $imageInfos = $imageInfos ? $imageInfos : null;

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $sizeInfos = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $sizeInfos = $sizeOk;
        $sizeOk = $maxSize > 0 ? $sizeOk <= $maxSize : true;
        if($sizeOk) {
            echo "File is an image - " . $sizeOk["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    return false;
}

function check_filesize($fileData) {
    // Check file size
    // $fileData = $_FILES["fileToUpload"];
    if ($fileData["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
}

function checkFileType($fileData, string $expectedType) : bool {
    // check file extension

    // check mime type to ensure security
    // mime_content_type(resource|string $filename): string|false

    return false;
}

function do_test() {

}

function displayArticleEditPage(string $code) {
    echo "Page displayArticleEditPage under construction ";

    // if no override: display-only mode
    //      will display edit screen for this product

    // if there is a product code availabe,
    //      if there are data about the product being edited ...,
    //          update the records in BDD with the new infos
    //      otherwise
    //          will display edit screen for this product
    //              the page's fields must be pre-filled with the infos from the BDD

}

function deleteArticle(string $code) {
    if (removeArticle($code)) {
        header("Location: /index?action=articles-admin", true, 301);
        return;
    }
    // maybe display an error message
    echo "Error while trying to delete the article ". $code . ".";
//    header("Location: /index?action=articles-admin", true, 301);
}

function canAlterCatalog(): bool {
    return ($_SESSION??array())["isAdmin"] ?? false;
}
