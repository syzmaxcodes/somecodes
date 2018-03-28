

<?php foreach ($parentThis as $order):?>
    <li>
        <i><img src="<?= Yii::$service->product->image->getResize($order['image'],[150,150],false) ?>" alt="<?= $order['name'] ?>" width="75" height="75"></i>
        <div class="detail-info">
            <div class="sp-title"><?php echo $order['name'];?></div>

            <div class="price-num">
                <span><?php echo $order['price'];?>元/箱</span>
                <span>x<?php echo $order['qty'];?></span>
            </div>
        </div>
    </li>
<?php endforeach;?>
