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


class Index
{
    protected $numPerPage = 10;
    protected $pageNum;
    protected $orderBy;
    protected $customer_id;
    protected $_page = 'p';

    /**
     * 初始化类变量.
     */
    public function initParam()
    {
        if (!Yii::$app->user->isGuest) {
            $identity = Yii::$app->user->identity;
            $this->customer_id = $identity['id'];
        }
        $this->pageNum = (int) Yii::$app->request->get('p');

        $this->pageNum = ($this->pageNum >= 1) ? $this->pageNum : 1;
//        var_dump($this->pageNum);die;
        $this->orderBy = ['created_at' => SORT_DESC];
    }

    public function getLastData($status = '')
    {
        $this->initParam();
        $return_arr = [];
        if ($this->customer_id) {
            $filter = [
                'numPerPage'    => $this->numPerPage,
                'pageNum'        => $this->pageNum,
                'orderBy'        => $this->orderBy,
                'where'            => [
                    ['customer_id' => $this->customer_id],
                ],
                'asArray' => true,
            ];
            $customer_order_list = Yii::$service->order->coll($filter);
            $return_arr['order_list'] = $customer_order_list['coll'];
            $count = $customer_order_list['count'];
            $pageToolBar = $this->getProductPage($count);
            $return_arr['pageToolBar'] = $pageToolBar;
        }
        if(!empty($status))
        {
            foreach ($return_arr['order_list'] as $value)
            {
                if($value['order_status'] == $status)
                {
                    $order_list['order_list'][] = $value;
                }
            }
            return $order_list;
        }
        return $return_arr;
    }


    protected function getProductPage($countTotal)
    {
        if ($countTotal <= $this->numPerPage) {
            return '';
        }
        $config = [
            'class'        => 'fecshop\app\apphtml5\widgets\Page',
            'view'        => 'widgets/page.php',
            'pageNum'        => $this->pageNum,
            'numPerPage'    => $this->numPerPage,
            'countTotal'    => $countTotal,
            'page'            => $this->_page,
        ];

        return Yii::$service->page->widget->renderContent('category_product_page', $config);
    }

    //    public function getLastData($data){
//        return $this->get_order_status($data);
//    }

    public function get_first_order_detail($data)
    {
        $item = new Item();
        foreach ($data['order_list'] as $key => $value){
            $data['order_list'][$key]['detail'] = $item->find()
                ->where('order_id = :oid',[':oid' => $value['order_id']])
                ->asArray()
                ->one();
        }
        return $data;
    }
//    public function get_first_order_detail_2($data)
//    {
//        $item = new Item();
//        foreach ($data as $key => $value){
//            foreach ($value as $val)
//            {
////                var_dump($val);die;
//                $data[$key]['detail'] = $item->find()
//                    ->where('order_id = :oid',[':oid' => $val['order_id']])
//                    ->asArray()
//                    ->one();
//            }
//        }
//        return $data;
//    }

    /**
     * @param $order_list
     * @return array
     * @author syz
     * 订单状态
     */
    public function get_order_status_2($order_list){
        //订单状态
        $order_status = [];
        $order_status['payment_pending'] = 0;//待付款
        $order_status['payment_processing'] = 0;//付款处理中
        $order_status['payment_confirmed'] = 0;//收款成功
        $order_status['payment_suspected_fraud'] = 0;//欺诈
        $order_status['payment_canceled'] = 0;//订单支付取消
        $order_status['holded'] = 0;//订单审核中
        $order_status['processing'] = 0;//订单备货处理中
        $order_status['dispatched'] = 0;//订单发货
        $order_status['refunded'] = 0;//订单退款
        $order_status['completed'] = 0;//订单完成
        foreach ($order_list as $order){
            if($order['order_status'] == 'payment_pending'){
                $order_status['payment_pending'] += 1;
            }elseif ($order['order_status'] == 'payment_processing'){
                $order_status['payment_processing'] += 1;
            }elseif ($order['order_status'] == 'payment_confirmed'){
                $order_status['payment_confirmed'] += 1;
            }elseif ($order['order_status'] == 'payment_suspected_fraud'){
                $order_status['payment_suspected_fraud'] += 1;
            }elseif ($order['order_status'] == 'payment_canceled'){
                $order_status['payment_canceled'] += 1;
            }elseif ($order['order_status'] == 'holded'){
                $order_status['holded'] += 1;
            }elseif ($order['order_status'] == 'processing'){
                $order_status['processing'] += 1;
            }elseif ($order['order_status'] == 'dispatched'){
                $order_status['dispatched'] += 1;
            }elseif ($order['order_status'] == 'refunded'){
                $order_status['refunded'] += 1;
            }elseif ($order['order_status'] == 'completed'){
                $order_status['completed'] += 1;
            }
            $order_status['order_total'] += 1;
        }
        return $order_status;
    }

    /**
     * @param $order_list
     * @return array
     * @author syz
     * 订单状态
     */
    public function get_order_status($order_list){
        //订单状态
        $order_status = [];
        $order_status['payment_pending'] = 0;//待付款
        $order_status['payment_processing'] = 0;//付款处理中
        $order_status['payment_confirmed'] = 0;//收款成功
        $order_status['payment_suspected_fraud'] = 0;//欺诈
        $order_status['payment_canceled'] = 0;//订单支付取消
        $order_status['holded'] = 0;//订单审核中
        $order_status['processing'] = 0;//订单备货处理中
        $order_status['dispatched'] = 0;//订单发货
        $order_status['refunded'] = 0;//订单退款
        $order_status['completed'] = 0;//订单完成
        foreach ($order_list['order_list'] as $order){
            if($order['order_status'] == 'payment_pending'){
                $order_status['payment_pending'] += 1;
            }elseif ($order['order_status'] == 'payment_processing'){
                $order_status['payment_processing'] += 1;
            }elseif ($order['order_status'] == 'payment_confirmed'){
                $order_status['payment_confirmed'] += 1;
            }elseif ($order['order_status'] == 'payment_suspected_fraud'){
                $order_status['payment_suspected_fraud'] += 1;
            }elseif ($order['order_status'] == 'payment_canceled'){
                $order_status['payment_canceled'] += 1;
            }elseif ($order['order_status'] == 'holded'){
                $order_status['holded'] += 1;
            }elseif ($order['order_status'] == 'processing'){
                $order_status['processing'] += 1;
            }elseif ($order['order_status'] == 'dispatched'){
                $order_status['dispatched'] += 1;
            }elseif ($order['order_status'] == 'refunded'){
                $order_status['refunded'] += 1;
            }elseif ($order['order_status'] == 'completed'){
                $order_status['completed'] += 1;
            }
            $order_status['order_total'] += 1;
        }
        return $order_status;
    }




}