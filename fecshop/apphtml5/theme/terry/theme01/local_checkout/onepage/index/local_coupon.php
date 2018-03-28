<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
?>
<?php
use fecshop\app\apphtml5\helper\Format;
?>
<?php    $local_coupon = $parentThis['local_coupon'];   ?>
<div class="onestepcheckout-shipping-method">
    <p class="onestepcheckout-numbers onestepcheckout-numbers-2">分享卡卷</p>
    <div class="onestepcheckout-shipping-method-block">
        <dl class="">

            <?php if(!empty($local_coupon) &&  is_array($local_coupon)): ?>
                <?php 	foreach($local_coupon as $coupon): ?>

                    <div class="shippingmethods">
                        <div class="flatrate"><?= $coupon['name'] ?></div>
                        <div>
                            <input data-role="none" <?= $coupon['checked'] ? 'checked="checked"' : '' ?> type="radio" id="" value="<?= $coupon['method'] ?>" class="validate-one-required-by-name" name="local_coupon_method">
                            <label for=""><?= $coupon['name'] ?>
                            </label>
                        </div>
                    </div>
                <?php 	endforeach; ?>
            <?php endif; ?>


        </dl>
    </div>
</div>