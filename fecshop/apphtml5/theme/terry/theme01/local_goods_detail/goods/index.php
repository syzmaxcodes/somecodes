
<div class="page-group">
    <div class="page page-current">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left"></a>
            <a class="icon iconfont icon-gouwuche pull-right"></a>
            <!--<a class="icon iconfont icon-fenxiang pull-right marginright05"></a>-->
            <h1 class="title"><?php echo $goods['name']?></h1>
        </header>
        <nav class="bar bar-tab">
            <a class="tab-item external" href="#" id="addGWC">
                加入购物车
            </a>
        </nav>
        <div class="content">
            <div class="buttons-tab fixed-tab" data-offset="44">
                <a href="#tab1" class="tab-link active button">商品</a>
                <a href="#tab2" class="tab-link button">详情</a>
                <a href="#tab3" class="tab-link button">评价</a>
            </div>

            <div class="content-block ">
                <div class="tabs">
                    <div id="tab1" class="tab active">

                        <input type="hidden" id="main_img" value="<?= Yii::$service->product->image->getResize($goods['image_thumbnails']['main']['image'],[100,100],false)  ?>">

                                <?php # 图片部分。
                                $imageView = [
                                    'view'	=> 'local_goods_detail/goods/index/image.php'
                                ];
                                $product['gallery'] = $goods['image_detail'];
                                $product['main'] = $goods['image_thumbnails']['main'];
                                $imageParam = [
                                    'media_size' => $goods['media_size'],
                                    'image' => $product,
                                    'productImgMagnifier' => $goods['productImgMagnifier'],
                                ];

                                ?>
                                <?= Yii::$service->page->widget->render($imageView,$imageParam); ?>


                        <div class="scrollShow"></div>
                        <div class="share-info">
                            <div class="share-text">
                                <p class="s-title"><?php echo $goods['name']?> 8两左右/条</p>
                                <p>口感柔韧有弹性</p>
                            </div>
                            <div class="share-btn">
                                <i class="icon iconfont icon-fenxiang"></i>
                                <p>分享</p>
                            </div>
                        </div>
                        <div class="jgsl">
                            <div class="jiage">
                                <span>¥<?php echo $goods['price_info']['price']['value'];?>.00</span>
                                <span>/箱(5斤装)</span>
                                <span>¥10.00/包(8两)</span>
                            </div>
                            <span class="sl">1箱起批</span>
                            <div class="bz">
                                <span>已成交16斤</span>
                                <span>快递：10.00</span>
                                <span>发货地：象山 石浦</span>
                            </div>
                        </div>
                        <div class="guige">
                            <div class="guigeL">
                                <i>
                                    <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/guige.png','apphtml5')?>" class="myImg" />
                                </i>
                                <span>已选择：150g/条</span>
                            </div>
                            <i>
                                <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/arrow.png','apphtml5')?>" class="myImg" />
                            </i>
                        </div>
                    </div>
                    <div id="tab2" class="tab">

                            <?php
                            //详情描述
                            if(is_array($goods['groupAttrArr'])): ?>
                                <table>
                                    <?php foreach($goods['groupAttrArr'] as $k => $v): ?>
                                        <tr>
                                            <td><?= Yii::$service->page->translate->__($k); ?></td>
                                            <td><?= Yii::$service->page->translate->__($v); ?></td></tr>
                                    <?php endforeach; ?>
                                </table>
                                <br/>
                            <?php endif; ?>

                            <?= $goods['description']; ?>
                            <div class="img-section">
                                <?php   if(is_array($goods['image_detail'])):  ?>
                                    <?php foreach($goods['image_detail'] as $image_detail_one): ?>
                                        <br/>
                                        <img class="lazy" src="<?= Yii::$service->image->getImgUrl('images/lazyload.gif');   ?>" data-src="<?= Yii::$service->product->image->getUrl($image_detail_one['image']); //->getResize($image_detail_one['image'],550,false) ?>"  />

                                    <?php  endforeach;  ?>
                                <?php  endif;  ?>
                            </div>


                    </div>

<!--                    <div id="tab3" class="tab">-->
<!--                    </div>-->



                </div>
            </div>
        </div>

    </div>
</div>
<div class="product_info">
<input type="hidden" class="product_view_id" value="<?php echo $goods['oid'];?>">
<input type="hidden" class="sku" value="<?php echo $goods['sku']?>" />
<input type="hidden" class="spu" name="" value="<?php echo $goods['spu']?>" />
</div>




