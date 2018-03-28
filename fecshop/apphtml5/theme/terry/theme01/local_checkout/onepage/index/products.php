
<ul id="dd-list">
    <?php foreach ($parentThis['products'] as $product):?>
    <li>
        <i>
            <img src="<?= Yii::$service->product->image->getResize($product['product_image']['main']['image'],[150,150],false) ?>" alt="<?= $product_one['name'] ?>" width="75" height="75">

        </i>
        <div class="detail-info">
            <div class="sp-title"><?php echo $product['product_name']['name_zh']?></div>
            <div class="fh-time">发货时间：卖家承诺7天内发货</div>
            <div class="price-num">
                <span><?php echo $product['product_price']?>元/箱</span>
                <span>x<?php echo $product['qty']?></span>
            </div>
        </div>
        <?php endforeach;?>
    </li>
</ul>