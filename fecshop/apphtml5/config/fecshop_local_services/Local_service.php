<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 *
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 * 定义本地的组件及模块
 */
return [
    //获取购物车信息
    'get_cart' => [
        'class' => 'fecshop\app\apphtml5\modules\Checkout\block\cart\Index',
    ],
    'checkout_cart' => [
        'class' =>'fecshop\app\apphtml5\modules\Checkout\block\onepage\Index',
    ],
    //结算
    'placeorder' => [
        'class' => 'fecshop\app\apphtml5\modules\Checkout\block\onepage\Placeorder',
    ],
    //链接到本地的onepage block
    'local_checkout_cart' => [
        'class' =>'apphtml5\local\local_modules\Local_checkout\block\onepage\Index',
    ],
    //获取本地订单
    'local_order_list' => [
        'class' => 'apphtml5\local\local_modules\Local_checkout\block\order\Index',
    ],
    //本地的公共函数
    'local_common' => [
        'class' => 'apphtml5\helper\Common_function',
    ],
   //获取商品详情
    'goods_detail' => [
        'class' => 'fecshop\app\apphtml5\modules\Catalog\block\product\Index',
    ],
    //本地订单验证
    'local_placeorder' => [
        'class' => 'apphtml5\local\local_modules\Local_checkout\block\onepage\Placeorder',
    ],
];

