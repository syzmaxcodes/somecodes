<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Local_checkout\block\order;

use Yii;
use yii\base\InvalidValueException;
use fecshop\models\mysqldb\order\Item;
use fecshop\models\mysqldb\Order;

class Order_detail
{
    /*
    * 获取订单详情
    */
    public function get_order_products($order_id)
    {
        $item = new Item();
        return $order_detail = $item->find()->where('order_id = :oid',[':oid' => $order_id])->asArray()->all();
    }
    //获取订单详情
    public function get_order_detail($order_id)
    {
        $order_info = new Order();
        return $order_info->find()->where('order_id = :oid',[':oid' => $order_id])->asArray()->one();
    }
}