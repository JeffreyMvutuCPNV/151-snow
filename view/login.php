<?php
/**
 * @file      login.php
 * @brief     This view is designed to display the login page
 * @author    Created by Jeffrey.MVUTU-MABILAMA
 * @version   2021.11.16
 * @date      2021.11.16
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
					<form action="view/login.php" class="leave-comment">
						<h4 class="m-text26 p-b-36 p-t-15">
Connectez-vous
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="email" placeholder="Adresse email">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="userPswd" placeholder="Mot de passe">
						</div>
						<input type="submit" value="login" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4"><br>
						<input type="reset" value="Annuler" class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">

					</form>
				</div>
            </div>
        </div>
    </section>

<?php
$content = ob_get_clean();
require "view/gabarit.php";
?>