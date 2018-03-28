

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
            'position' =>  'POS_HEAD',
            //	'condition'=> 'lt IE 9',
        ],
        'js'	=>[
            'js/jquery-3.3.1.min.js',
        ],
    ],
];
# css config
$cssOptions = [
    # css config 1.
    [
        'css'	=>[
            'css/dingdan.css',
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
        <nav class="bar bar-tab">
            <a class="tab-item external active" href="<?= Yii::$service->url->getUrl('index/index/home')?>">
                <span class="icon iconfont icon-shouye"></span>
                <span class="tab-label">首页</span>
            </a>
            <a class="tab-item external" href="<?= Yii::$service->url->getUrl('local_checkout/order')?>">
                <span class="icon iconfont icon-dingdan"></span>
                <span class="tab-label">订单</span>
            </a>
            <a class="tab-item external" href="<?= Yii::$service->url->getUrl('local_checkout/cart')?>">
                <span class="icon iconfont icon-gouwuche"></span>
                <span class="tab-label">购物车</span>
            </a>
            <a class="tab-item external" href="<?= Yii::$service->url->getUrl('customer/account/index')?>">
                <span class="icon iconfont icon-wode"></span>
                <span class="tab-label">我的</span>
            </a>
        </nav>
        <div class="content">
            <div class="buttons-tab">
                <span id="all_orders"  class="tab-link active button">全部<span class="small-info"><?php echo $order_status['order_total'];?></span></span>
                <span id="payment_pending"  class="tab-link button">待付款<span  class="small-info"><?php echo $order_status['payment_pending'];?></span></span>
                <span id="payment_confirmed"  class="tab-link button">待收货<span class="small-info"><?php echo $order_status['payment_confirmed'];?></span></span>
                <span id="completed"  class="tab-link button">待评价<span class="small-info"><?php echo $order_status['completed'];?></span></span>
            </div>
            <div class="content-block content-block-no">
                <div class="tabs">
                    <div id="tab1" class="tab active">
                        <div class="content-block content-block-no">
                            <div class="content-block-title">共<?php echo $order_status['order_total'];?>个订单</div>
<!--                            --><?php
//                            $parentThis['order_list'] = $order_list['order_list'];
//                            //                            $parentThis['name'] = 'featured';
//                            $config = [
//                                'view'  		=> 'local_checkout/order/index/order_list.php',
//                            ];
//                            echo Yii::$service->page->widget->renderContent('category_product_price',$config,$parentThis);
//                            ?>
                            <p class="foot-info">已经全部加载完毕</p>
                        </div>
                        <div id="tab2" class="tab">
                            <div class="content-block">
                                <p>This is tab 2 content</p>
                            </div>
                        </div>
                        <div id="tab3" class="tab">
                            <div class="content-block">
                                <p>This is tab 3 content</p>
                            </div>
                        </div>
                        <div id="tab4" class="tab">
                            <div class="content-block">
                                <p>This is tab 4 content</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       window.onload = function () {

               var url = "/local_checkout/order/api";
               $.ajax({
                   type:'get',
                   url:url,
                   async:false,
                   dataType:'json',
                   success:function(request)
                   {
                       console.log(request)
                   }
               })
           }

    </script>

