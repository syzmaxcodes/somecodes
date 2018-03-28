<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Local_customer\block\account;

use Yii;
use apphtml5\local\local_models\mysqldb\Weixin_user_info;
use fecshop\models\mysqldb\Customer;
use fecshop\models\mysqldb\Order;
use fecshop\models\mysqldb\Cart;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Index
{
    public function getLastData()
    {
        $identity = Yii::$app->user->identity;

        return [
            'accountEditUrl' => Yii::$service->url->getUrl('customer/editaccount'),
            'email'            => $identity['email'],
            'accountAddressUrl' => Yii::$service->url->getUrl('customer/address'),
            'accountOrderUrl' => Yii::$service->url->getUrl('customer/order'),
        ];
    }


    public function get_user_detail_info($data)
    {
        $user_id = $data['id'];
        //用户信息
        $customer = new Customer();
        $sql = "select c.id,c.firstname,wu.headimgurl from customer as c left join wechat_user as wu on wu.customer_id = c.id  where wu.customer_id = '{$user_id}'";
        $db  = Yii::$app->db;
        $command = $db->createCommand($sql);
        $user_info = $command->queryOne();
        $user_info['headimgurl'] = unserialize($user_info['headimgurl']);

        //订单
        $sql = "select sfo.order_id,sfo.order_status,sfo.total_weight,sfo.order_currency_code,sfo.grand_total,sfo.subtotal,sfo.payment_method,sfo.shipping_method,sfo.shipping_total,sfo.customer_telephone,sfo.customer_address_state,sfo.customer_address_city,sfo.customer_address_street1,sfo.customer_address_street2,sfo.order_remark,sfo.paypal_order_datetime from sales_flat_order as sfo where customer_id = {$user_id}";
        $command = $db->createCommand($sql);
        $orders = $command->queryAll();

        //购物车信息
        $cart = new Cart();
        $cart_count = $cart->find()->where('customer_id = :cid',[':cid' => $user_id])->count();

        $count = count($orders);
        $payment_pending = 0;
        $processing = 0;
        $completed = 0;
        foreach ($orders as $value)
        {
            if($value['order_status'] == 'payment_pending') $payment_pending += 1;
            if($value['order_status'] == 'processing') $processing += 1;
            if($value['order_status'] == 'completed') $completed += 1;//待评价
        }
        return [
            'user_info'       => $user_info,
            'count'           => $count,
            'payment_pending' => $payment_pending,
            'processing'      => $processing,
            'completed'       => $completed,
            'orders'          => $orders,
            'cart_count'      => $cart_count,
        ];
    }




}
