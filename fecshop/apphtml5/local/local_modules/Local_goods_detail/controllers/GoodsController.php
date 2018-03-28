<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Local_goods_detail\controllers;

use fecshop\app\apphtml5\modules\AppfrontController;
use Yii;
use yii\web\Response;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class GoodsController extends AppfrontController
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
        $goods = $this->getBlock()->getLastData();
        $oid = (array)$goods['_id'];
        $goods['oid'] = $oid['oid'];//获取商品的id
//        var_dump($goods);die;
        //获取购物车的物品
        return $this->render('index',['goods' => $goods]);
    }

    function get_goods()
    {
        return Yii::$service->goods_detail->getLastData();
    }


}