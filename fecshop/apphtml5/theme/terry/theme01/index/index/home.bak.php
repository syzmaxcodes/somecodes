

<header id="search" dd_name="首页搜索区">
    <div class="dd-logo">
<!--        <a href="" dd_name="logo跳转"></a>-->
    </div>
    <div class="search_box">
        <div class="search">
            <form id="index_search_form" method="get" action="" target="_parent" onsubmit="return submit_search();">
                <div class="text_box">
                    <input id="keyword" name="keyword" type="text" placeholder="请输入您的宝贝" class="keyword text" onkeydown="this.style.color=&#39;#404040&#39;" autocomplete="off">
                </div>
                <input type="submit" value="" class="submit" dd_name="搜索">
                <input type="hidden" value="d256b1d537fe186e53c0444399341c24" name="sid">
            </form>
        </div>
    </div>
    <div class="header-category"><a href="" dd_name="跳转分类"><em>分类</em></a></div>
    <div class="search_list"></div>
</header>
<section id="wrapper">
    <section class="top-slider-wrapper" dd_name="首页焦点轮播区">
        <section data-widget="topSlider" class="J_top_slider index-slider">
            <ul class="top-slider" style="width: 500%; -webkit-transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); -webkit-transform: translate(-2588px, 0px) translateZ(0px);">
                <li style="width:20%">
                    <a href="" dd_name="焦点轮播图1">
                        <img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/lxqj-0929-700-270.jpg','apphtml5') ?>"  alt="预留" />
                    </a>
                </li>
                <li style="width:20%">
                    <a href="" dd_name="焦点轮播图2">
                        <img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/108-700-270.jpg','apphtml5') ?>"  alt="预留" />
                    </a>
                </li>
                <li style="width:20%">
                    <a href="" dd_name="焦点轮播图3">
                        <img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/nbewxj-1008-700x270.jpg','apphtml5') ?>"  alt="预留" />
                    </a>
                </li>
                <li style="width:20%">
                    <a href="" dd_name="焦点轮播图4">
                        <img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/700270jinse922.jpg','apphtml5') ?>"  alt="预留" />
                    </a>
                </li>
                <li style="width:20%">
                    <a href="" dd_name="焦点轮播图5">
                        <img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/700-270-0801.jpg','apphtml5') ?>"  alt="预留" />
                    </a>
                </li>
            </ul>
            <div class="top-slider-indicator">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot on"></span>
            </div>
        </section>
    </section>
    <ul class="index-nav" dd_name="首页功能区">
        <li><a href="" dd_name="分类"><img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/fenlei.png','apphtml5') ?>"  alt="预留" /><span>分类</span></a></li>
        <li><a href="<?= Yii::$service->url->getUrl('local_checkout/cart'); ?>" dd_name="购物车">
                <img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/fenlei.png','apphtml5') ?>"  alt="预留" /><span>购物车</span></a></li>
        <li><a href="<?= Yii::$service->url->getUrl('checkout/onepage/index'); ?>" dd_name=""><img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/wodedangdang-h5.png','apphtml5') ?>"  alt="预留" /><span>个人信息</span></a></li>
        <li><a href="" dd_name="电子书">
                <img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/dianzihsu.png','apphtml5') ?>"  alt="预留" /><span>更多商品</span></a></li>
    </ul>
<!--    <section class="seckilling" dd_name="首页秒杀区">-->
<!--        <div class="seckilling-box">-->
<!--            <div class="seckilling-title">-->
<!--                <span class="seckilling-name">秒购</span>-->
<!--                <span class="seckilling-icon"></span>-->
<!--                <div class="seckilling-content" data-widget="countdown" data-end-time="1444381201" data-left-time="12191" data-is-begin="0">-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="seckilling-con" id="seckill_index">-->
<!--                <ul class="clearfix">-->
<!--                    <li>-->
<!--                        <a href="" dd_name="秒杀品1">-->
<!--                            <p class="pic"><img class="" src="images/1199158435-1_b.jpg"></p>-->
<!--                            <p class="price">-->
<!--                                <span class="rob">-->
<!--                                    <span class="sign">¥</span>-->
<!--                                    <span class="num">1.00</span>-->
<!--                                    <span class="tail"></span>-->
<!--                                </span>-->
<!--                            </p>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="" dd_name="秒杀品2">-->
<!--                            <p class="pic"><img class="" src="images/1317267830-1_b.jpg"></p>-->
<!--                            <p class="price">-->
<!--                                <span class="rob">-->
<!--                                    <span class="sign">¥</span>-->
<!--                                    <span class="num">1.00</span>-->
<!--                                    <span class="tail"></span>-->
<!--                                </span>-->
<!--                                <!--<span class="discount">折</span>-->
<!--                            </p>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="" dd_name="秒杀品3">-->
<!--                            <p class="pic"><img class="" src="images/1231286936-1_b.jpg"></p>-->
<!--                            <p class="price">-->
<!--                                <span class="rob">-->
<!--                                    <span class="sign">¥</span>-->
<!--                                    <span class="num">1.00</span>-->
<!--                                    <span class="tail"></span>-->
<!--                                </span>-->
<!--                                <!--<span class="discount">折</span>-->
<!--                            </p>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="" dd_name="秒杀品3">-->
<!--                            <p class="pic"><img class="" src="images/4.jpg"></p>-->
<!--                            <p class="price">-->
<!--                                <span class="rob">-->
<!--                                    <span class="sign">¥</span>-->
<!--                                    <span class="num">1.00</span>-->
<!--                                    <span class="tail"></span>-->
<!--                                </span>-->
<!--                                <!--<span class="discount">折</span>-->
<!--                            </p>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="" dd_name="秒杀品3">-->
<!--                            <p class="pic"><img class="" src="images/5.jpg"></p>-->
<!--                            <p class="price">-->
<!--                                <span class="rob">-->
<!--                                    <span class="sign">¥</span>-->
<!--                                    <span class="num">1.00</span>-->
<!--                                    <span class="tail"></span>-->
<!--                                </span>-->
<!--                                <!--<span class="discount">折</span>-->
<!--                            </p>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="" dd_name="秒杀品3">-->
<!--                            <p class="pic"><img class="" src="images/6.jpg"></p>-->
<!--                            <p class="price">-->
<!--                                <span class="rob">-->
<!--                                    <span class="sign">¥</span>-->
<!--                                    <span class="num">1.00</span>-->
<!--                                    <span class="tail"></span>-->
<!--                                </span>-->
<!--                                <!--<span class="discount">折</span>-->
<!--                            </p>-->
<!--                        </a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <section class="banner" dd_name="楼间推荐区">
        <section data-widget="bannerSlider" class="J_banner_slider banner-slider" id="bannerSlider_99659" dd_name="轮播推荐区99659">
            <ul class="banner-slider" style="width: 200%; -webkit-transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); transition: 0ms cubic-bezier(0.1, 0.57, 0.1, 1); -webkit-transform: translate(-647px, 0px) translateZ(0px);">
                <li style="width:50%">
                    <a href="" dd_name="轮播推荐1"><img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/10banner-620X1501.jpg','apphtml5') ?>"  alt="预留" /></a>
                </li>
                <li style="width:50%">
                    <a href="" dd_name="轮播推荐2"><img class="lazy" data-src="<?= Yii::$service->image->getImgUrl('images/lppz600-150.jpg','apphtml5') ?>"  alt="预留" /></a>
                </li>
            </ul>
            <div class="banner-slider-indicator">
                <span class="dot"></span>
                <span class="dot on"></span>
            </div>
        </section>
    </section>
    <section class="floor" dd_name="">
        <h2>
            <a class="title">推荐商品</a>
<!--            <a href="" class="more" dd_name="更多">更多</a>-->
        </h2>
        <dl>
            <?php
            $parentThis['products'] = $bestFeaturedProducts;
            $parentThis['name'] = 'featured';
            $config = [
                'view'  		=> 'index/index/product.php',
            ];
//            var_dump(Yii::$service->page);die;
            echo Yii::$service->page->widget->renderContent('category_product_price',$config,$parentThis);
            ?>
<!--            <dt><a href="" dd_name=""><img class="" src="images/DHC-h51.jpg"></a></dt>-->
<!---->
<!--            <dd><a href=""><img class="" src="images/liangpinpuzih53.jpg"></a></dd>-->
<!---->
<!--            <dd><a href=""><img class="" src="images/doujiangjih52.jpg"></a></dd>-->

        </dl>
    </section>
    <section class="floor" dd_name="">
        <h2>
            <a class="title">优惠商品</a>
<!--            <a href="" class="more" dd_name="更多">更多</a>-->
        </h2>
        <dl>
<!--            <dt><a href=""><img class="" src="images/h5-k1-1008-nbewxj2015.jpg"></a></dt>-->
<!---->
<!--            <dd><a href=""><img class="" src="images/h5-k3-1008-xsqxk.jpg"></a></dd>-->
<!---->
<!--            <dd><a href=""><img class="" src="images/h5-k2-1008-slbdmj.jpg"></a></dd>-->

        </dl>
    </section>

</section>


<div class="fixed_box" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1); display: none;">
    <a href="javascript:scrollTo(0,0)" class="btn_back" id="backtop"><img style="width:2rem" src="images/go-top.png"></a>
</div>
<footer class="footer new">
    <section class="status-bar">
        <div class="actions-wrap">
            <a href="">登录</a>
            <a href="">注册</a>
        </div>
        <a class="top" href="javascript:scrollTo(0,0);">TOP</a>
    </section>
    <nav class="b-nav">
        <p>
            <a href="" ontouchstart="">提建议</a>
            <a class="red" href="" ontouchstart="">触屏版</a>
            <a href="" ontouchstart="">电脑版</a>
            <a href="" ontouchstart="">帮&nbsp;&nbsp;助</a>
        </p>
    </nav>
    <section class="copyright">
        <p>Copyright 京都 2015 meijiashangcheng.com</p>
    </section>
</footer>
