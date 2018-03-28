
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
$jsOptions = [
    # js config 1
    [
        'options' => [
            'position' =>  'POS_END',
            //	'condition'=> 'lt IE 9',
        ],
        'js'	=>[

        ],
    ],
];
# css config
$cssOptions = [
    # css config 1.
    [
        'css'	=>[
            'css/order-detail.css',
        ],
    ],
];
\Yii::$service->page->asset->jsOptions 	= \yii\helpers\ArrayHelper::merge($jsOptions, \Yii::$service->page->asset->jsOptions);
\Yii::$service->page->asset->cssOptions = \yii\helpers\ArrayHelper::merge($cssOptions, \Yii::$service->page->asset->cssOptions);
\Yii::$service->page->asset->register($this);
?>
<body>
<div class="page-group">
    <div class="page page-current">
        <div class="content">

            <?php
            if($order_detail['order_status'] == 'completed'):
                $parentThis['order_list'] = $order_list['order_list'];
                //                            $parentThis['name'] = 'featured';
                $config = [
                    'view'  		=> 'local_checkout/order/order_detail/order_end.php',
                ];
                echo Yii::$service->page->widget->renderContent('category_product_price',$config,$parentThis);
            endif;
            ?>

            <div class="goods-info">
                <div class="name-phone">
                    <span>收货人：<?php echo $order_detail['customer_firstname'] . $order_detail['customer_lastname'] ;?></span>
                    <span><?php echo $order_detail['customer_telephone']?></span>
                </div>
                <div class="address">
                    <i>
                        <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/position.png','apphtml5')?>"  class="myImg" />
                    </i>
                    <div class="address-content mylink"><?php echo $order_detail['customer_address_city'].$order_detail['customer_address_zip'].$order_detail['customer_address_street1']?></div>
                </div>
            </div>
            <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/address.jpg','apphtml5')?>" class="myImg" />
            <ul id="dd-list">

                <?php
                $parentThis = $order_products;
                $config = [
                    'view'  		=> 'local_checkout/order/order_detail/order_list.php',
                ];
                echo Yii::$service->page->widget->renderContent('category_product_price',$config,$parentThis);
                ?>
            </ul>
            <ul id="price-info">
                <li>
                    <span>运费：</span>
                    <span>¥123</span>
                </li>
                <li>
                    <span>促销价：</span>
                    <span>¥123</span>
                </li>
                <li>
                    <span>优惠券：</span>
                    <span>¥123</span>
                </li>
                <li>
                    <span>实付款：</span>
                    <span>¥123</span>
                </li>
            </ul>
            <div class="dd-detail">
                <p>订单编号：<?php echo $order_detail['increment_id'];?></p>
                <p>支付时间：<?php echo date('Y-m-d,H:i:s',$order_detail['created_at']);?></p>
                <p>支付方式：在线支付</p>
            </div>
        </div>
    </div>
</div>

