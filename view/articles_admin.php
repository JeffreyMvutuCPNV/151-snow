<?php

/**
 * @file      articles_admin.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.12.14
 * @date      14.12.2021
 */


ob_start();
$title = "Articles Management";

?>

    <!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1">Article</th>
							<th class="column-1">Photo</th>
							<th class="column-2">Modèle</th>
							<th class="column-3">Longueur</th>
							<th class="column-4 p-l-70">Prix à l'unité</th>
							<th class="column-5">Quantité</th>
							<th class="column-5">
<!--                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">-->
                                <a href="/index.php?action=article-add">
                                    <button class="flex-c-m size1 bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Ajouter
                                    </button>
                                </a>
                            </th>
						</tr>

                    <?php
                    foreach ($productsList as $product) :
                    ?>
						<tr class="table-row">
							<td class="column-1">
                                <?= $product["code"] ?>
							</td>
                            <td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
                                    <?php if (is_file($product['photo'])) : ?>
                                        <img src="<?= $product['photo'] ?>" alt="Image of product <?= $product['code'] ?>">
                                    <?php else: ?>
                                        <img src="/view/content/images/no_image_snow.png" alt="No image">
                                    <?php endif; ?>
								</div>
							</td>
							<td class="column-2"><?= $product["model"] ?></td>
                            <td class="column-3"><?= $product["snowLength"] ?> cm</td>
                            <td class="column-4"><?= $product["price"] ?> CHF</td>
                            <td class="column-5"><?= $product["qtyAvailable"] ?></td>
                            <td class="column-5">
                                <?php $msgConfirmDelete = "Are you sure you want to delete article ".$product["brand"]." ".$product["model"]." ?" ?>
                                <form action="/index.php?action=article-delete" method="POST" onsubmit="return confirm ('<?= $msgConfirmDelete ?>')">
                                    <!--                                    <a href="/index.php?action=article-add">-->
                                    <input type="hidden" name="artcode" value="<?= $product['code'] ?>">
                                    <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Effacer
                                    </button>
                                    <!--                                    </a>-->
                                </form>

                                <br>

                                <a href="/index.php?action=article-edit&artcode=<?= $product['code'] ?>">
                                    <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                        éditer
                                    </button>
                                </a>
                            </td>
						</tr>

                    <?php endforeach; ?>

					</table>
				</div>
			</div>

		</div>
	</section>



<?php
$content = ob_get_clean();
require "gabarit.php";
?>
