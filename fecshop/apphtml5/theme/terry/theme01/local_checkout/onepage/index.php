


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
            'css/sure-order.css',
        ],
    ],
];
\Yii::$service->page->asset->jsOptions 	= \yii\helpers\ArrayHelper::merge($jsOptions, \Yii::$service->page->asset->jsOptions);
\Yii::$service->page->asset->cssOptions = \yii\helpers\ArrayHelper::merge($cssOptions, \Yii::$service->page->asset->cssOptions);
\Yii::$service->page->asset->register($this);
?>

<form action="<?= Yii::$service->url->getUrl('local_checkout/onepage'); ?>" method="post" id="onestepcheckout-form">

    <?= \fec\helpers\CRequest::getCsrfInputHtml(); ?>

    <div class="page-group">
        <div class="page page-current">
            <nav class="bar bar-tab myfoot">
                <div class="total">合计 <span id="price">¥<?php echo $products['cart_info']['grand_total']?></span></div>
                <div class="settlement " id="onestepcheckout-place-order">提交订单</div>
            </nav>
            <div class="content">
                <div class="goods-info">
                    <div class="name-phone">
                        <span>收货人：<?php echo $products['cart_address']['first_name'].$products['cart_address']['last_name']?></span>
                        <span><?php echo $products['cart_address']['telephone']?></span>
                    </div>
                    <div class="address">
                            <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/position.png','apphtml5')?>" />
                        </i>
                        <div class="address-content mylink " >
                            <input type="hidden" name="address_list" class="address_list" value="<?php echo $products['cart_address']['city'].$products['cart_address']['street1'].$products['cart_address']['zip']?>">
                            <input type="hidden" name="address_id" class="address_id" value="<?php echo $products['cart_address_id'] ?>">



                            <input type="hidden" name="billing[first_name]" class="address_list" value="<?php echo $products['cart_address']['first_name']?>">
                            <input type="hidden" name="billing[last_name]" class="address_list" value="<?php echo $products['cart_address']['last_name'] ?>">
                            <input type="hidden" name="billing[email]" class="address_list" value="<?php echo $products['cart_address']['email']?>">
                            <input type="hidden" name="billing[telephone]" class="address_list" value="<?php echo $products['cart_address']['telephone'] ?>">
                            <input type="hidden" name="billing[street1]" class="address_list" value="<?php echo $products['cart_address']['street1']?>">
                            <input type="hidden" name="billing[street2]" class="address_list" value="<?php echo $products['cart_address']['street2']?>">
                            <input type="hidden" name="billing[country]" class="address_list" value="<?php echo $products['cart_address']['country']?>">

                            <input type="hidden" name="payment_method" class="payment_method" value="check_money">





                            <?php echo $products['cart_address']['city'].$products['cart_address']['street1'].$products['cart_address']['zip']?>

<!--                            <div class="onestepcheckout-column-left">-->
<!--                                --><?php //# address 部门
//
//                                //echo $address_view_file;
//                                $addressView = [
//                                    'view'	=> 'local_checkout/onepage/index/address_select.php',
//                                ];
//                                //var_dump($address_list);
//                                $addressParam = [
//                                    'cart_address_id' 	=> $products['cart_address_id'],
//                                    'address_list'	  	=> $products['address_list'],
//                                    'customer_info'	  	=> $products['customer_info'],
//                                    'country_select'  	=> $products['country_select'],
//                                    'state_html'  	  	=> $products['state_html'],
//                                    'cart_address'		=> $products['cart_address'],
//                                    //'payments' => $payments,
//                                    //'current_payment_mothod' => $current_payment_mothod,
//                                ];
//                                ?>
<!--                                --><?//= Yii::$service->page->widget->render($addressView,$addressParam); ?>
<!---->
<!--                            </div>-->


                        </div>
                    </div>
                </div>
                <img class="lazy myImg" data-src="<?= Yii::$service->image->getImgUrl('images/address.jpg','apphtml5')?>" />

                <?php
                $parentThis['products'] = $products['cart_info'];
                $parentThis['name'] = 'featured';
                $config = [
                    'view'  		=> 'local_checkout/onepage/index/products.php',
                ];
                echo Yii::$service->page->widget->renderContent('category_product_price',$config,$parentThis['products']);
                ?>

                <ul id="ps-info">
                    <li class="mylink">
                        <span>发票</span>
                    </li>
                    <li>
                        <span>买家留言：</span>
                        <input id="jiaoYiShuoMing" type="text" placeholder="填写对本次交易的说明"/>
                    </li>
                    <li class="flex-between">
                        <span>配送方式</span>
                        <span>快递¥10.00</span>
                    </li>
                </ul>
                <div class="heji">共<?php echo $products['cart_info']['items_count']?>件商品 小计：<span>¥<?php echo $products['cart_info']['grand_total']?></span></div>
            </div>
        </div>
    </div>
</form>

<script>
    <?php $this->beginBlock('placeOrder') ?>
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    // ajax
    function ajaxreflush(){
        shipping_method = $("input[name=shipping_method]:checked").val();

        country = $(".billing_country").val();
        address_id = $(".address_list").val();
        state   = $(".address_state").val();
        //alert(state);
        if(country || address_id){
            $(".onestepcheckout-summary").html('<div style="text-align:center;min-height:40px;"><img src="<?= Yii::$service->image->getImgUrl('images/ajax-loader.gif'); ?>"  /></div>');
            $(".onestepcheckout-shipping-method-block").html('<div style="text-align:center;min-height:40px;"><img src="<?= Yii::$service->image->getImgUrl('images/ajax-loader.gif'); ?>"  /></div>');
            ajaxurl = "<?= Yii::$service->url->getUrl('checkout/onepage/ajaxupdateorder');  ?>";
            $.ajax({
                async:false,
                timeout: 8000,
                dataType: 'json',
                type:'get',
                data: {
                    'country':country,
                    'shipping_method':shipping_method,
                    'address_id':address_id,
                    'state':state,
                },
                url:ajaxurl,
                success:function(data, textStatus){
                    status = data.status;
                    if(status == 'success'){
                        $(".review_order_view").html(data.reviewOrderHtml)
                        $(".shipping_method_html").html(data.shippingHtml);

                    }

                },
                error:function (XMLHttpRequest, textStatus, errorThrown){
                }
            });
        }
    }
    $(document).ready(function(){
        currentUrl = "<?= Yii::$service->url->getUrl('checkout/onepage') ?>"
        //优惠券
        $(".add_coupon_submit").click(function(){
            coupon_code = $("#id_couponcode").val();
            coupon_type = $(".couponType").val();
            coupon_url = "";
            $succ_coupon_type = 0;
            if(coupon_type == 2){
                coupon_url = "<?=  Yii::$service->url->getUrl('checkout/cart/addcoupon'); ?>";
                $succ_coupon_type = 1;
            }else if(coupon_type == 1){
                coupon_url = "<?=  Yii::$service->url->getUrl('checkout/cart/cancelcoupon'); ?>";
                $succ_coupon_type = 2;
            }
            //alert(coupon_type);
            if(!coupon_code){
                //alert("coupon can not empty!");
            }
            //coupon_url = $("#discount-coupon-form").attr("action");
            //alert(coupon_url);
            $.ajax({
                async:true,
                timeout: 6000,
                dataType: 'json',
                type:'post',
                data: {"coupon_code":coupon_code},
                url:coupon_url,
                success:function(data, textStatus){
                    if(data.status == 'success'){
                        $(".couponType").val($succ_coupon_type);
                        hml = $('.add_coupon_submit').html();
                        if(hml == 'Add Coupon'){
                            $('.add_coupon_submit').html('<?= Yii::$service->page->translate->__('Cancel Coupon');?>');
                        }else{
                            $('.add_coupon_submit').html('<?= Yii::$service->page->translate->__('Add Coupon');?>');
                        }
                        $(".coupon_add_log").html("");
                        ajaxreflush();
                    }else if(data.content == 'nologin'){
                        $(".coupon_add_log").html("<?= Yii::$service->page->translate->__('you must login your account before you use coupon');?>");
                    }else{
                        $(".coupon_add_log").html(data.content);
                    }
                },
                error:function (XMLHttpRequest, textStatus, errorThrown){}
            });
        });

        // 对于非登录用户，可以填写密码，进行注册账户，这里进行信息的检查。
        $("#id_create_account").click(function(){
            if($(this).is(':checked')){
                email = $("input[name='billing[email]']").val();
                if(!email){
                    $(this).prop('checked', false);
                    $(".label_create_account").html(" <?= Yii::$service->page->translate->__('email address is empty, you must Fill in email');?>");
                }else{
                    thischeckbox = this;
                    if(!validateEmail(email)){
                        $(this).prop('checked', false);
                        $(".label_create_account").html(" <?= Yii::$service->page->translate->__('email address format is incorrect');?>");
                    }else{
                        // ajax  get if  email is register
                        $.ajax({
                            async:true,
                            timeout: 6000,
                            dataType: 'json',
                            type:'get',
                            data: {"email":email},
                            url:"<?= Yii::$service->url->getUrl('customer/ajax/isregister'); ?>",
                            success:function(data, textStatus){
                                if(data.registered == 2){
                                    $(".label_create_account").html("");
                                    $("#onestepcheckout-li-password").show();
                                    $("#onestepcheckout-li-password input").addClass("required-entry");

                                }else{
                                    $(thischeckbox).prop('checked', false);
                                    $(".label_create_account").html(" <?= Yii::$service->page->translate->__('This email is registered , you must fill in another email');?>");
                                }
                            },
                            error:function (XMLHttpRequest, textStatus, errorThrown){}
                        });
                    }
                }
            }else{
                $(".label_create_account").html("");
                $("#onestepcheckout-li-password").hide();
                $("#onestepcheckout-li-password input").removeClass("required-entry");
            }
        });
        //###########################
        //下单(这个部分未完成。)
        $("#onestepcheckout-place-order").click(function(){

            $(".validation-advice").remove();
            i = 0;
            j = 0;

            address_list = $(".address_list").val();

            // shipping
//            shipment_method = $(".onestepcheckout-shipping-method-block input[name='shipping_method']:checked").val();
//			alert(shipment_method);
//            if(!shipment_method){
//                $(".shipment-methods").after('<div style=""  class="validation-advice"><?//= Yii::$service->page->translate->__('This is a required field.');?>//</div>');
//                j = 1;
//            }
////			alert(j);
//            //payment
//            payment_method = $("#checkout-payment-method-load input[name='payment_method']:checked").val();
//			alert(payment_method);
//            if(!payment_method){
//                $(".checkout-payment-method-load").after('<div style=""  class="validation-advice"><?//= Yii::$service->page->translate->__('This is a required field.');?>//</div>');
//                j = 1;
//            }

            if(address_list){
                if(!j){
//                    alert(11)
                    $(".onestepcheckout-place-order").addClass('visit');
                    $("#onestepcheckout-form").submit();
                }

            }else{
                //alert(11);

                $("#onestepcheckout-form .required-entry").each(function(){
                    value = $(this).val();

                    if(!value){
                        //alert(this);
                        //alert($(this).attr('name'));
                        i++;
                        $(this).after('<div style=""  class="validation-advice"><?= Yii::$service->page->translate->__('This is a required field.');?></div>');
                    }
                });
//                alert(10)
                //email  format validate
                user_email = $("#billing_address .validate-email").val();
//                alert(user_email)
                if(user_email && !validateEmail(user_email)){
                    $("#billing_address .validate-email").after('<div style=""  class="validation-advice"><?= Yii::$service->page->translate->__('email address format is incorrect');?></div>');
                    i++;
                }
                // password 是否长度大于6，并且两个密码一致
                if($("#id_create_account").is(':checked')){
                    new_user_pass = $(".customer_password").val();
                    new_user_pass_cm = $(".customer_confirm_password").val();
                    //alert(new_user_pass);
                    //alert(new_user_pass.length);
                    //alert(new_user_pass_cm);
                    <?php
                    $passwdMinLength = Yii::$service->customer->getRegisterPassMinLength();
                    $passwdMaxLength = Yii::$service->customer->getRegisterPassMaxLength();
                    ?>
                    passwdMinLength = "<?= $passwdMinLength ?>";
                    passwdMaxLength = "<?= $passwdMaxLength ?>";
                    if(new_user_pass.length < passwdMinLength){
                        $(".customer_password").after('<div style=""  class="validation-advice"><?= Yii::$service->page->translate->__('Password length must be greater than or equal to {passwdMinLength}',['passwdMinLength' => $passwdMinLength]);?></div>');
                        i++;
                    }else if(new_user_pass.length > passwdMaxLength){
                        $(".customer_password").after('<div style=""  class="validation-advice"><?= Yii::$service->page->translate->__('Password length must be less than or equal to {passwdMaxLength}',['passwdMaxLength' => $passwdMaxLength]);?></div>');
                        i++;
                    }else if(new_user_pass != new_user_pass_cm){
                        $(".customer_confirm_password").after('<div style=""  class="validation-advice"><?= Yii::$service->page->translate->__('The passwords are inconsistent');?></div>');
                        i++;
                    }
                }
//                alert(12)
                if(!i && !j){
                    //alert(333);
                    $(".onestepcheckout-place-order").addClass('visit');
                    $("#onestepcheckout-form").submit();
                }
            }

        });
        //登录用户切换地址列表
        $(".address_list").change(function(){
            val = $(this).val();
            if(!val){
                $(".billing_address_list_new").show();

                $(".save_in_address_book").attr("checked","checked");
                ajaxreflush();

            }else{
                $(".billing_address_list_new").hide();
                $(".save_in_address_book").attr("checked",false);
                addressid = $(this).val();

                if(addressid){
                    ajaxreflush();
                }
            }
        });
        // 国家选择后，state需要清空，重新选择或者填写
        $(".billing_country").change(function(){
            country = $(this).val();
            //state   = $(".address_state").val();
            //shipping_method = $("input[name=shipping_method]:checked").val();
            //alert(shipping_method);

            //$(".onestepcheckout-shipping-method-block").html('<div style="text-align:center;min-height:40px;"><img src="http://www.intosmile.com/skin/default/images/ajax-loader.gif"  /></div>');
            //$(".onestepcheckout-summary").html('<div style="text-align:center;min-height:40px;"><img src="http://www.intosmile.com/skin/default/images/ajax-loader.gif"  /></div>');
            ajaxurl = "<?= Yii::$service->url->getUrl('checkout/onepage/changecountry'); ?>";

            $.ajax({
                async:true,
                timeout: 8000,
                dataType: 'json',
                type:'get',
                data: {
                    'country':country,
                    //'shipping_method':shipping_method,
                    //'state':state
                },
                url:ajaxurl,
                success:function(data, textStatus){
                    $(".state_html").html(data.state);

                },
                error:function (XMLHttpRequest, textStatus, errorThrown){
                }
            });
            ajaxreflush();
        });
        // state select 改变后的事件
        $(".input-state").off("change").on("change","select.address_state",function(){
            ajaxreflush();
        });
        // state input 改变后的事件
        $(".input-state").off("blur").on("blur","input.address_state",function(){
            ajaxreflush();
        });
        //改变shipping methos
        $(".onestepcheckout-column-middle").off("click").on("click","input[name=shipping_method]",function(){
            ajaxreflush();
        });
    });
    //ajaxreflush();
    <?php $this->endBlock(); ?>
    <?php $this->registerJs($this->blocks['placeOrder'],\yii\web\View::POS_END);//将编写的js代码注册到页面底部 ?>

</script>

