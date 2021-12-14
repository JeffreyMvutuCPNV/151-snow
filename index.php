<?php
/**
 * @file      index.php
 * @brief     This file is the rooter managing the link with controllers.
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   26-MAR-2021
 */

session_start();

require_once "utils/constants.php";

require "controller/navigation.php";
require "controller/users.php";
require "controller/articles.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            home();
            break;
        case 'articles' :
            displayArticlesPage();
            break;
        case 'articles-admin' :
            displayArticlesAdminPage();
            break;
        case 'article-detail' :
            displayArticleDetailPage($_GET['artcode']);
            break;
        case 'login' :
            login($_POST);
            break;
        case 'signup' :
            signup($_POST);
            break;
        case 'logout' :
            logout();
            break;
        case 404:
        default :
            lost();
    }
} else {
    home();
}