<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
?>


<?php  if(is_array($parentThis['products']) && !empty($parentThis['products'])): ?>
    <?php foreach($parentThis['products'] as $product): ?>
        <?php  if(isset($product['sku']) && $product['sku']): ?>
            <a href="<?= $product['url'] ?>" external>
                <div class="sp-card">
                    <div class="card-info">
                        <p class="card-name"><?php echo $product['name'];?></p>
                        <div class="card-dj">¥<?php echo $product['price'];?><span>/包(8两)</span></div>
                        <div class="card-tc">¥120.00<span>/箱(5斤装)</span></div>
                    </div>
                    <i><img width="100%" src="<?= Yii::$service->image->getImgUrl('images/lazyload.gif'); ?>"  class="lazy" data-src="<?= Yii::$service->product->image->getResize($product['image'],296,false) ?>"  /></i>
                </div>
            </a>
        <?php endif; ?>
    <?php  endforeach;  ?>
<?php  endif;  ?>
<div class="sp-card">
    <div class="card-info">
        <p class="card-name">象山野生 小黄鱼</p>
        <div class="card-dj">¥10.00<span>/包(8两)</span></div>
        <div class="card-tc">¥120.00<span>/箱(5斤装)</span></div>
    </div>
    <i><img src="images/xhy.png" class="myImg"/></i>
</div>
