<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 *
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */
return [
    'User_info' => [
        'class' => 'apphtml5\local\local_services\index\User_info',
        'childService' => [
            //用户链接数据库（微信）
            'user_info_weixin_db' => [
                'class' => 'apphtml5\local\local_models\mysqldb\Weixin_user_info',
                ],
            //卡卷信息链接数据库
            'local_coupon_db' => [
                'class' => 'apphtml5\local\local_models\mysqldb\Local_coupon_info',
            ],
            //获取首页的商品
            'get_products' => [
                'class' => 'fecshop\app\apphtml5\modules\Cms\block\home\Index',
            ],
            //用户订单
            'get_orders' => [
                'class' => 'fecshop\app\apphtml5\modules\Customer\block\order\Index',
            ],
            'Local_coupon' => [
                'class' => 'apphtml5\helper\Coupon_action',
            ],
        ],
    ],
    'weixin' => [
        'class' => 'apphtml5\helper\Weixin',
    ],
];