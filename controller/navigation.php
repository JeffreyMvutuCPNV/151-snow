<?php
/**
 * @file      controller.php
 * @brief     Controller
 * @author    Created by Frederique.ANDOLFATT
 * @date      2021.11.08
 * @version   2021.11.16
 * @collaborator    Jeffrey Mvutu Mabilama
 * @update    16.11.2021
 *            Added login page
 */


/**
 * @brief This function is designed to redirect the user to the home page (depending on the action received by the index)
 */
function home()
{
    require "view/home.php";
}


/**
 * @brief This function is designed to redirect the user to the login page (depending on the action received by the index)
 */
function login()
{
    require "view/login.php";
}



/**
 * @brief This function is designed to inform the user that the resource requested doesn't exist (i. e. if the user modify the url manually)
 */
function lost()
{
    require "view/lost.php";
}
