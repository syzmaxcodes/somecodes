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
use fecshop\app\apphtml5\helper\Format;
?>

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
//            'js/swiper.min.js',

        ],
    ],
];
# css config
$cssOptions = [
    # css config 1.
    [
        'css'	=>[
            'css/gouwuche.css',
        ],
    ],
];
\Yii::$service->page->asset->jsOptions 	= \yii\helpers\ArrayHelper::merge($jsOptions, \Yii::$service->page->asset->jsOptions);
\Yii::$service->page->asset->cssOptions = \yii\helpers\ArrayHelper::merge($cssOptions, \Yii::$service->page->asset->cssOptions);
\Yii::$service->page->asset->register($this);
?>

<!--<link href="/apphtml5/theme/terry/theme01/assets/css/gouwuche.css" rel="stylesheet">-->

<div class="page-group">

    <?php  if(is_array($cart_info) && !empty($cart_info)):   ?>

    <div class="page page-current">
        <nav class="bar bar-tab myfoot">

            <div class="cart_select_div">
                <input id="cart_select_all" type="checkbox" name="cart_select_all" class="cart_select cart_select_all">
                &nbsp;
                <label for="cart_select_all">全选</label>
            </div>
            <div class="total">合计&nbsp;<span id="price">¥<?php echo $cart_info['base_product_total']?></span></div>
            <div class="freight">不含运费</div>
            <div class="settlement settlement_cart " onclick="location.href='<?= Yii::$service->url->getUrl('local_checkout/onepage');  ?>'">结算(<span id="num"><?php echo $cart_info['items_count']?></span>)</div>
        </nav>
        <div class="content">
            <div class="list-block media-list">
                <ul id="buy-list">
                <?php if(is_array($cart_info['products']) && (!empty($cart_info['products']))): ?>
                    <?php foreach($cart_info['products'] as $product_one): ?>
                    <li>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide content-swiper">

                                    <div class="col-33">
                                        <input rel="<?= $product_one['item_id']; ?>" <?=  ($product_one['active'] == Yii::$service->cart->quoteItem->activeStatus ) ?  'checked="checked"' : '' ?> type="checkbox" name="cart_select_item" class="cart_select cart_select_item">
                                        <a external href="<?= $product_one['url'] ?>" title="<?= $product_one['name'] ?>" class="product-image">
                                            <img src="<?= Yii::$service->product->image->getResize($product_one['image'],[150,150],false) ?>" alt="<?= $product_one['name'] ?>" width="75" height="75">
                                        </a>
                                    </div>

                                    <div class="content-info">
                                        <p><?php echo $product_one['name']?></p>
                                        <div class="price-num">
                                            <div class="price"><span><?php echo $product_one['product_price']?>元/斤</span></div>
<!--                                            <div class="W_input"></div>-->
                                            <div class="cart_qty">
                                                <a  externalhref="javascript:void(0)" class="cartqtydown changeitemqty" rel="<?= $product_one['item_id']; ?>" num="<?= $product_one['qty']; ?>">-</a>
                                                <input name="cart[qty]" size="4" title="Qty" class="input-text qty" rel="<?= $product_one['item_id']; ?>" maxlength="12" value="<?= $product_one['qty']; ?>">
                                                <a externalhref="javascript:void(0)" class="cartqtyup changeitemqty" rel="<?= $product_one['item_id']; ?>" num="<?= $product_one['qty']; ?>">+</a>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide deleteBtn btn-remove" rel="<?= $product_one['item_id']; ?>" >删除</div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                <?php endif; ?>

                </ul>
            </div>
        </div>
    </div>
    <?php else: ?>
        <!---若购物车没有商品则显示空购物车  细节待优化--->
        <div class="empty_cart ">
            <?php
            $param = ['urlB' => '<a  external rel="nofollow" href="'.Yii::$service->url->getUrl('customer/account/login').'">','urlE' =>'</a>'];
            ?>

            <div id="empty_cart_info">
                <?= Yii::$service->page->translate->__('Your Shopping Cart is empty');?>
                <a external href="<?= Yii::$service->url->homeUrl(); ?>"><?= Yii::$service->page->translate->__('Start shopping now!');?></a>
                <br>
                <?= Yii::$service->page->translate->__('Please {urlB}log in{urlE} to view the products you have previously added to your Shopping Cart.',$param);?>
            </div>
        </div>
        <div class="empty_cart_img">

        </div>
    <?php  endif; ?>
</div>










