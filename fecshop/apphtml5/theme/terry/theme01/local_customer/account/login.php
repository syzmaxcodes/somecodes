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
//            'css/login.css',
        ],
    ],
];
\Yii::$service->page->asset->jsOptions 	= \yii\helpers\ArrayHelper::merge($jsOptions, \Yii::$service->page->asset->jsOptions);
\Yii::$service->page->asset->cssOptions = \yii\helpers\ArrayHelper::merge($cssOptions, \Yii::$service->page->asset->cssOptions);
\Yii::$service->page->asset->register($this);

?>
<div class="shopping-cart-img">
    <?= Yii::$service->page->translate->__('Login'); ?>
    <a external href="<?= Yii::$service->url->getUrl('customer/account/register');  ?>" class="f-right"><?= Yii::$service->page->translate->__('Register'); ?></a>
</div>
<?= Yii::$service->page->widget->render('flashmessage'); ?>
<div class="list-block customer-login">
    <form action="<?= Yii::$service->url->getUrl("customer/account/login");  ?>" method="post" id="login-form" class="account-form">
        <ul>
            <li>
                <div class="item-content">
                    <div class="item-media"><i class="icon icon-form-email"></i></div>
                    <div class="item-inner">
                        <div class="item-input">
                            <input name="editForm[email]" value="<?= $email; ?>" id="email" type="email" placeholder="<?= Yii::$service->page->translate->__('E-mail'); ?>" autocomplete="new-password">
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="item-content">
                    <div class="item-media"><i class="icon icon-form-password"></i></div>
                    <div class="item-inner">
                        <div class="item-input">
                            <input type="password" placeholder="<?= Yii::$service->page->translate->__('Password'); ?>"  name="editForm[password]" class="input-text required-entry validate-password" id="pass" title="Password" autocomplete="new-password" >
                        </div>
                    </div>
                </div>
            </li>
            <?php if($loginPageCaptcha):  ?>
                <li>
                    <div class="item-content">
                        <div class="item-media"><i class="icon icon-form-password"></i></div>
                        <div class="item-inner">
                            <div class="item-input">
                                <input placeholder="captcha" type="text" name="editForm[captcha]" value="" size=10 class="login-captcha-input"><img class="login-captcha-img"  title="<?= Yii::$service->page->translate->__('click refresh'); ?>" src="<?= Yii::$service->url->getUrl('site/helper/captcha'); ?>" align="absbottom" onclick="this.src='<?= Yii::$service->url->getUrl('site/helper/captcha'); ?>?'+Math.random();"></img>
                                <span class="icon icon-refresh"></span>
                            </div>
                        </div>
                    </div>
                    <script>
                        <?php $this->beginBlock('login_captcha_onclick_refulsh') ?>
                        $(document).ready(function(){
                            $(".icon-refresh").click(function(){
                                $(this).parent().find("img").click();
                            });
                        });
                        <?php $this->endBlock(); ?>
                    </script>
                    <?php $this->registerJs($this->blocks['login_captcha_onclick_refulsh'],\yii\web\View::POS_END);//将编写的js代码注册到页面底部 ?>
                </li>
            <?php endif; ?>
        </ul>

        <div class="clear"></div>
        <div class="buttons-set">
            <p><a external href="#"  id="js_registBtn" class="button button-fill"><?= Yii::$service->page->translate->__('Sign In'); ?></a></p>
            <a external href="<?= Yii::$service->url->getUrl('customer/account/forgotpassword');  ?>" class="f-left"><?= Yii::$service->page->translate->__('Forgot Your Password?'); ?></a>

        </div>
        <div class="clear"></div>
        <div class="third_login">
            <div class="fago_login">
                <a external href="<?= Yii::$service->url->getUrl('local_customer/weixin/get_weixin_info');  ?>" class="f-left">
                    <img   src="<?=Yii::$service->image->getImgUrl("images/weixin.jpg") ?>" style="height: 33px;" /><br/>
                </a>
            </div>
            <?= \fec\helpers\CRequest::getCsrfInputHtml();  ?>
            <div class="col2-set">
                <div class="col-1 new-users">
                    <div class="buttons-set">

                    </div>
                </div>
                <div class="col-2 registered-users">

                </div>
            </div>
        </div>
    </form>
</div>




