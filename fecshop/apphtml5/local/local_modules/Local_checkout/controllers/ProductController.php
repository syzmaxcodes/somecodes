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
class ProductController extends AppfrontController
{

    public function init()
    {
        parent::init();
        //Yii::$service->page->theme->layoutFile = 'category_view.php';
    }

    /**
     * @return mixed
     * @author syz
     * 购物车页面
     */
    public function actionIndex(){
//        var_dump(1);die;
        //获取购物车的物品
        $products = Yii::$service->get_cart->getLastData();
//        var_dump($products);die;ls
        return $this->render($this->action->id,$products);
    }


}