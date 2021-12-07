<?php

/**
 * @file      signup.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.12.07
 * @date      07.12.2021
 */



ob_start();
$title = "SnowPoint . Login";

?>

<!-- Title Page -->
<!--    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(content/view/images/heading-pages-06.jpg);">-->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(view/content/images/heading-pages-06.jpg);">
    <h2 class="l-text2 t-center">
        Login
    </h2>
</section>


<!-- content page -->
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-b-30">
                <?php /* MVC : returning to the router, which will then direct to controller */ ?>
                <form action="index.php?action=signup" class="leave-comment" method="post">
                    <h4 class="m-text26 p-b-36 p-t-15">
                        Enregistrez-vous
                    </h4>
                    <?php
                    if (isset($error) && $error) {
                        if (!$errorMessages || count($errorMessages) == 0){
                            echo "<div class='text-warning'><span>". "Erreur lors de l'enregistrement" . "</span></div>";
                        } else {
                            foreach ($errorMessages as $errMsg){
                                echo "<div class='text-warning'><span>". $errMsg . "</span></div>";
                            }
                        }
                    }
                    ?>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="email" placeholder="Adresse email" required>
                    </div>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="userPswd" placeholder="Mot de passe" required>
                    </div>
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="userPswdVerify" placeholder="Vérification de mot de passe" required>
                    </div>

                    <p class="mt-3">
                        <span>En soumettant votre demande de compte, vous validez les conditions générales d'utilisation.</span>
                    </p>

                    <input type="submit" value="S'enregistrer" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4"><br>
                    <input type="reset" value="Annuler" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">

                    <p class="mt-3">
                        <span>Déjà membre ? <a href="/index.php?action=login">Login</a></span>
                    </p>

                </form>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>

