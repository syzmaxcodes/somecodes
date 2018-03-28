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
class OrderController extends AppfrontController
{

    public function init()
    {
        parent::init();
        //Yii::$service->page->theme->layoutFile = 'category_view.php';
    }

    /**
     * @return mixed
     * @author syz
     * 订单列表
     */
    public function actionIndex(){
        //为登陆则跳到登陆页面(暂定)
        $guestOrder = Yii::$app->controller->module->params['guestOrder'];
        if(!$guestOrder && Yii::$app->user->isGuest){
            $checkoutOrderUrl = Yii::$service->url->getUrl('checkout/onepage/index');
            Yii::$service->customer->setLoginSuccessRedirectUrl($checkoutOrderUrl);
            return Yii::$service->url->redirectByUrlKey('customer/account/login');
        }
        //获取订单列表
        $status = Yii::$app->request->get('status');
        if(!empty($status)){
            $order_list = $this->getBlock()->getLastData($status);
            $order_status = $this->getBlock()->get_order_status($order_list);
        }else{
            $order_list = $this->getBlock()->getLastData();
            $order_status = $this->getBlock()->get_order_status($order_list);
        }
        //获取订单第一个商品的详细信息
        $order_list = $this->getBlock()->get_first_order_detail($order_list);

        return $this->render($this->action->id,['order_list' => $order_list,'order_status' => $order_status]);


       // 获取订单列表
        $status = Yii::$app->request->get('status');
        if(!empty($status)){
            $order_list = $this->getBlock()->getLastData($status);
            $order_status = $this->getBlock()->get_order_status($order_list);
        }else{
            $order_list = $this->getBlock()->getLastData();
            $order_status = $this->getBlock()->get_order_status($order_list);
        }
        //获取订单第一个商品的详细信息
        $order_list = $this->getBlock()->get_first_order_detail($order_list);
//var_dump($this->getBlock());die;
        return $this->render($this->action->id);
    }

//    public function actionApi()
//    {
////        var_dump(Yii::$service->local_order_list->getLastData());die;
//        echo Yii::$service->local_order_list->getLastData();
//        exit();
//        $order_list = Yii::$service->Local_checkout->getBlock()->getLastData();
//        var_dump($order_list);die;
//        var_dump($_GET['p']);die;
//    }

    /**
     * @return mixed
     * @author syz
     * 订单详情
     */
    public function actionOrder_detail()
    {
        $order_id = Yii::$app->request->get('order_id');
        if(!empty($order_id))
        {
            $order_products = $this->getBlock()->get_order_products($order_id);//获取订单产品
            $order_detail = $this->getBlock()->get_order_detail($order_id);//订单详情
        }
        return $this->render($this->action->id,['order_detail' => $order_detail,'order_products' => $order_products]);
    }


    /**
     * @return mixed
     * @author syz
     * 重新下单
     */
    public function actionReorder()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$service->url->redirectByUrlKey('customer/account/login');
        }
        return $this->getBlock()->getLastData();
        //return $this->render($this->action->id,$data);
    }


}