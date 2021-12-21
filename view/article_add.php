<?php

/**
 * @file      article_add.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.12.17
 * @date      17.12.2021
 */


ob_start();
$title = "SP . Add Article ";

?>



<!-- Title Page -->
<!--    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(content/view/images/heading-pages-06.jpg);">-->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(view/content/images/heading-pages-06.jpg);">
    <h2 class="l-text2 t-center">
        Ajout d'article
    </h2>
</section>


<!-- content page -->
<section class="bgwhite p-t-66 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-b-30">
                <?php /* MVC : returning to the router, which will then direct to controller */ ?>
                <form action="/index.php?action=article-add" class="leave-comment" method="post"
                      enctype="multipart/form-data"
                >
                    <h4 class="m-text26 p-b-36 p-t-15">
                        Nouvel article
                    </h4>
                    <?php
                    if (isset($error) && $error) {
                        echo "<div class='text-warning'><span>". ($errorMsg ?? "Une erreur s'est produite") . "</span></div>";
                    }
                    ?>

<!--                    TODO : changer les champs "name" et type-->
                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="code" placeholder="Code de l'article" required>
                    </div>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="brand" placeholder="Marque de l'article" required>
                    </div>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="model" placeholder="Modèle de l'article" required>
                    </div>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="snowLength" placeholder="Longueur de l'article" required>
                    </div>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="price" placeholder="Prix à l'unité" required>
                    </div>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="qtyAvailable" placeholder="Quantité" required>
                    </div>


                    <div class="bo4 of-hidden size15 m-b-20">
                        <input class="sizefull s-text7 p-l-22 p-r-22" type="file" name="picture" placeholder="Article photo" required>
                    </div>

<!--                    <div class="bo4 of-hidden size15 m-b-20">-->
<!--                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="audience" placeholder="Pour qui ?" required>-->
<!--                    </div>-->

                    <select name="audience" id="gender">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                        <option value="Enfant">Enfant</option>
                    </select>

                    <div class="bo4 of-hidden size15 m-b-20">
                        <textarea class="sizefull s-text7 p-l-22 p-r-22 resize-no" type="text" name="description" placeholder="Description" required></textarea>
<!--                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="userPswd" placeholder="Description" required>-->
                    </div>



                    <div class="bo4 of-hidden size15 m-b-20">
                        <textarea class="sizefull s-text7 p-l-22 p-r-22 resize-no" type="text" name="descriptionFull" placeholder="Description complète" required></textarea>
<!--                        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="userPswd" placeholder="Description" required>-->
                    </div>


                    <input type="submit" value="Ajouter l'article" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4"><br>
                    <input type="reset" value="Annuler" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">

                </form>
            </div>
        </div>
    </div>
</section>



<?php
$content = ob_get_clean();
require "gabarit.php";
?>
