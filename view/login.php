<?php
/**
 * @file      login.php
 * @brief     This view is designed to display the login page
 * @author    Created by Jeffrey.MVUTU-MABILAMA
 * @author    Updated by Nicolas.GLASSEY
 * @version   16-NOV-2021
 */


ob_start();
$title = "SnowPoint . Login";

?>
<div class="col-md-12 p-b-30">
					<form class="leave-comment">
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

<?php
$content = ob_get_clean();
require "view/gabarit.php";
?>