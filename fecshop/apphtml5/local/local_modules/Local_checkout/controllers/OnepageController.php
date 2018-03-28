<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Local_checkout\controllers;

use fecshop\app\apphtml5\modules\AppfrontController;
use Yii;
use yii\web\Response;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class OnepageController extends AppfrontController
{

    public function init()
    {
        parent::init();
        //Yii::$service->page->theme->layoutFile = 'category_view.php';
    }

    /**
     * @return mixed
     * @author syz
     * 订单提交页面
     */
    public function actionIndex(){
//        var_dump(111);die;

        //未登陆用户跳转（测试用）
        $guestOrder = Yii::$app->controller->module->params['guestOrder'];
        if(!$guestOrder && Yii::$app->user->isGuest){
            $checkoutOrderUrl = Yii::$service->url->getUrl('checkout/onepage/index');
            Yii::$service->customer->setLoginSuccessRedirectUrl($checkoutOrderUrl);
            return Yii::$service->url->redirectByUrlKey('customer/account/login');
        }



        $_csrf = Yii::$app->request->post('_csrf');

        if ($_csrf) {

            $status = Yii::$service->local_placeorder->getLastData();
//            var_dump($status);die;
            if (!$status) {
                //var_dump(Yii::$service->helper->errors->get());
                //exit;
            }
        }
        //获取购物车的物品
        $products = Yii::$service->checkout_cart->getLastData();
        $products['local_coupon'] = [
            0 => [
                'value' => 0,
                'method' => 'use_coupon',
                'name' => '使用卡卷',
                'checked' => 'checked',
            ],
            1 => [
                'value' => 1,
                'method' => 'no_coupon',
                'name' => '不使用卡卷',
            ]
        ];
        //分享卡卷逻辑运算模块
        $products['cart_info'] = $this->getBlock()->getLastData($products['cart_info']);
        return $this->render($this->action->id,['products' => $products]);
    }

    /**
     * @author syz
     * 是否使用卡卷
     */
    public function actionChange_local_coupon(){
        if(Yii::$app->request->isGet){
            $products = Yii::$service->checkout_cart->getLastData();
            $type = Yii::$app->request->get('val');
            if($type == 'no_coupon'){
                //不使用卡卷
                $json_return = Yii::$service->local_common->json_retutn($products['cart_info']['product_total'],'success');
                echo $json_return;
                exit();
            }else{
                //使用卡卷
                $products['cart_info'] = Yii::$service->local_checkout_cart->getLastData($products['cart_info']);
                $json_return = Yii::$service->local_common->json_retutn($products['cart_info']['product_total'],'success');
                echo $json_return;
                exit();
            }
        }

    }


}