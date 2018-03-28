
<?php
$jsOptions = [
    # js config 1
    [
        'options' => [
            'position' =>  'POS_END',
            //	'condition'=> 'lt IE 9',
        ],
        'js'	=>[
            'config.js',
        ],
    ],
];
# css config
$cssOptions = [
    # css config 1.
    [
        'css'	=>[
            'css/mine.css',
        ],
    ],
];
\Yii::$service->page->asset->jsOptions 	= \yii\helpers\ArrayHelper::merge($jsOptions, \Yii::$service->page->asset->jsOptions);
\Yii::$service->page->asset->cssOptions = \yii\helpers\ArrayHelper::merge($cssOptions, \Yii::$service->page->asset->cssOptions);
\Yii::$service->page->asset->register($this);
?>



<div class="page-group">
    <div class="page page-current">


        <nav class="bar bar-tab">
            <a class="tab-item external " href="<?= Yii::$service->url->getUrl('index/index/home')?>">
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
            <a class="tab-item external active" href="<?= Yii::$service->url->getUrl('local_customer/account/index')?>">
                <span class="icon iconfont icon-wode"></span>
                <span class="tab-label">我的</span>
            </a>
        </nav>
        <div class="content">
            <div class="bg-sea">
                <div class="myInfo">
                    <i><img src="<?php echo $data['user_info']['headimgurl']?>" class="myImg"/></i>
                    <p><?php echo $data['user_info']['firstname']?></p>
                </div>
            </div>
            <div class="allDingdan">
                <span>我的订单</span>
                <span>查看全部订单 ></span>
            </div>
            <ul class="dd-type">
                <li>
                    <i>
                        <span><?php echo $data['count']?></span>
                        <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/dfk.png','apphtml5')?>" class="myImg" />
                    </i>
                    <p>待付款</p>
                </li>
                <li>
                    <i>
                        <span><?php echo $data['payment_pending']?></span>
                        <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/dfh.png','apphtml5')?>" class="myImg" />
                    </i>
                    <p>待发货</p>
                </li>
                <li>
                    <i>
                        <span><?php echo $data['processing']?></span>
                        <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/dsh.png','apphtml5')?>" class="myImg" />
                    </i>
                    <p>待收货</p>
                </li>
                <li>
                    <i>
                        <span><?php echo $data['completed']?></span>
                        <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/dpj.png','apphtml5')?>" class="myImg" />
                    </i>
                    <p>待评价</p>
                </li>
            </ul>
            <div class="gouwuche" onclick="demo()">
                <span>购物车</span>
                <div>
                    <span class="badge"><?php echo $data['cart_count']?></span>
                    >
                </div>
            </div>
            <div class="address-gl">
                <span>收货地址管理</span>
                <span>></span>
            </div>
            <div class="lxkf">联系客服</div>
        </div>
    </div>
</div>

