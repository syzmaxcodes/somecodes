
<body >
<div class="page-group">
    <div class="page page-current">
        <header class="bar bar-nav">
            <a class="icon iconfont icon-wode pull-left"></a>
            <a class="icon iconfont icon-gouwuche pull-right"></a>
            <h1 class="title"><i><img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/title.png','apphtml5')?>" /></i></h1>
        </header>
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
            <a class="tab-item external" href="<?= Yii::$service->url->getUrl('local_customer/account/index')?>">
                <span class="icon iconfont icon-wode"></span>
                <span class="tab-label">我的</span>
            </a>
        </nav>
        <div class="content">
            <div class="banner">
                <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/banner.jpg','apphtml5')?>" />
            </div>
            <?php
            $parentThis['products'] = $bestFeaturedProducts;
            $parentThis['name'] = 'featured';
            $config = [
                'view'  		=> 'index/index/product.php',
            ];
            //            var_dump(Yii::$service->page);die;
            echo Yii::$service->page->widget->renderContent('category_product_price',$config,$parentThis);
            ?>
        </div>

    </div>
</div>
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<!--<script type='text/javascript' src='./js/config.js' charset='utf-8'></script>-->
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/??sm.min.js,sm-extend.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//res.wx.qq.com/open/js/jweixin-1.2.0.js' charset='utf-8'></script>

