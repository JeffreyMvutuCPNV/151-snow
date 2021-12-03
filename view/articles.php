<?php

/**
 * @file      articles.php
 * @project   151-snow
 * @brief     File description
 * @author    Created by Jeffrey.MVUTU-MABILA
 * @version   2021.11.30
 * @date      30.11.2021
 */



ob_start();
$title = "SnowPoint . Articles";

?>






<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(view/content/images/home_slide_2.jpg);">
    <h2 class="l-text2 t-center">
        Nos snows
    </h2>
    <p class="m-text13 t-center">
<!--        New Arrivals Collection 2021 -->
    </p>
</section>


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">

            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50 mx-auto">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    <span class="s-text8 p-t-5 p-b-5">
                        Showing 1–<?= $totalProductsCount ?> of <?= $totalProductsCount ?> results
                    </span>
                </div>

                <!-- Product -->
                <div class="row">
                    <?php // TODO : ....
                    foreach ($productsList as $product) :
                    ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                <img src="<?= $product['photo'] ?>" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                        <!-- Button -->
                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a href="index?action=article-detail&artcode=<?= $product['code'] ?>" class="block2-name dis-block s-text3 p-b-5">
                                    <?= $product["brand"] ?>
                                    <?= $product["model"] ?>
                                </a>

                                <span class="block2-name dis-block s-text3 p-b-5">
                                    <b>Disponibilité :</b>
                                    <?=  $product["qtyAvailable"] ?? 0 ?>
                                    <br>
                                </span>

                                <span class="block2-price m-text6 p-r-5">
                                        <?= number_format($product["price"] / 100, 2) ?> CHF
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; // product iteration
                    ?>

                </div>

                <!-- Pagination -->
                <?php // TODO : page numbers ?>
                <div class="pagination flex-m flex-w p-t-26">
                    page 1 / 1
<!--                    <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>-->
<!--                    <a href="#" class="item-pagination flex-c-m trans-0-4">2 (TODO)</a>-->
                </div>

            </div>
        </div>
    </div>
</section>






<?php
$content = ob_get_clean();
require "gabarit.php";
?>
