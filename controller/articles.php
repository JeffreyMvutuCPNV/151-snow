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

        $theImage = $imageInfos["picture"] ?? array();
        $success = imageIsFitting($theImage, 1_000_000);

        $target_dir = "view/content/images/custom/"; // destination directory for product pictures
        $target_file = $target_dir . basename($theImage["name"]);
        $moved_ok = false;
        if ($success)
            $moved_ok = rename($theImage["tmp_name"], $target_file);

        $target_file = $moved_ok ? $target_file : $theImage["tmp_name"];

        $success = $success && addNewArticle($data, $target_file);

        if ($success) {
            header("Location: /index?action=articles-admin", true, 301);
        } else {
            // TODO : show error messages
            $error = true;
            $errorMsg = $errorMsg ?? "Certains champs requis sont absents.";
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

function imageIsFitting(array $imageInfos, int $maxSize=-1): bool {
    // save picture to temporary place : auto

//        check image file size < 1MB
//        check image dimensions
//        check image file type is png or jpeg/jpg
//        check field "Pour qui" has an accepted value
//        move image file to correct destination


    $imageInfos = $imageInfos ? $imageInfos : null;
    if (!$imageInfos)
        return false;

    $target_dir = "view/content/images/custom/"; // destination directory for product pictures

    // file extenstion
    $target_file = $target_dir . basename($imageInfos["name"]);
    $imageExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // $extension = $imageExtension in array("png", "jpg","jpeg", "gif");

    $filepath = $imageInfos["tmp_name"];
    // Check if image file is a actual image or fake image
    // $mimeType = mime_content_type($filepath);
    $mimeType = finfo_file( finfo_open( FILEINFO_MIME_TYPE ), $filepath );

    $allowedFileTypes = ['image/png', 'image/jpeg', 'image/gif'];
    $isImage = in_array($mimeType, $allowedFileTypes);

    if (!$mimeType || !$isImage)
        return false;

    $sizeInfos = getimagesize($imageInfos["tmp_name"]);
    if (!$sizeInfos)
        return false; // the dimensions cannot be checked

    $width = $sizeInfos[0];
    $height = $sizeInfos[1];
    $sizeOk = $width <= 1024 && $height <= 1024;
    $sizeOk = $maxSize > 0 ? $sizeOk <= $maxSize : true;
    $uploadOk = $sizeOk;
//    if($sizeOk) {
//        echo "File is an image - " . $sizeOk["mime"] . ".";
//    } else {
//        echo "File is not an image.";
//    }

    return isset($uploadOk) && $uploadOk;
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
