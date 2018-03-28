
<?php foreach ($parentThis['order_list'] as $order):?>
    <input type="hidden" value="<?php echo $order['order_id']?>" class="order_id">
    <div class="card">
        <div class="card-header myheader">
            <span class="name"><?php echo $order['customer_firstname'].$order['customer_lastname']?></span>
            <div class="time">
                <i></i>
                <span><?php echo date('Y-m-d H:i:s',$order['created_at']);?></span>
            </div>
        </div>
        <div class="card-content">
            <div class="list-block media-list">
                <ul>
                    <li>
                        <a href="<?= Yii::$service->url->getUrl('local_checkout/order/order_detail?order_id=' . $order['order_id']); ?>" class="item-content">
                            <div class="item-media">
                                <img src="<?= Yii::$service->product->image->getResize($order['detail']['image'],[150,150],false) ?>" alt="<?= $product_one['name'] ?>" width="75" height="75">
                            </div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title"><?php echo $order['detail']['name']?></div>
                                    <div class="item-after"><?php echo $order['subtotal'];?><span>元/斤</span></div>
                                </div>
                                <div class="item-subtitle">象山</div>
                                <div class="item-text">平均单个重：6斤打底</div>
                            </div>
                        </a>
                        <div class="detail">
                            <span class="textOver">订单来自供应 <?php echo $order['increment_id'];?></span>
                            <span><?php echo $order['detail']['weight']?>斤</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-footer">
            <span class="price">¥4400.00</span>
            <div class="btnbox">
                <?php if($order['order_status'] == 'payment_pending'):
                   echo "<a href=\"#\" id='go_pay'>去支付</a>\n";
                endif;?>
                <?php if($order['order_status'] == 'completed'):
                    echo "<a href=\"#\"><span id='go_reorder'>再来一单</span></a>\n";
                    echo "<a href=\"#\"><span id='go_pingjia'>评价</span></a>";
                endif;?>
            </div>
        </div>
    </div>
<?php endforeach;?>





