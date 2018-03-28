<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Local_checkout\block\onepage;

use Yii;
use yii\base\InvalidValueException;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Index
{
    public function getLastData($data){
        $session = Yii::$app->session;
        $local_coupon = $session->get('local_coupon');
        //验证该卡卷是否已经被核销
        $check_coupon = $this->check_coupon($local_coupon);
        if(!empty($check_coupon)){
            $data = $this->get_local_coupon_count($data,json_decode($check_coupon['type']));
            return $data;
        }

    }

    public function check_coupon($data){
        $coupon = Yii::$service->User_info->local_coupon_db;
        $result = $coupon->find()->where('primary_code = :pcode and wcode = :wcode',[':pcode' => $data['code'],':wcode' => $data['wcode']])->asArray()->one();
        if($result['status'] == '0'){
            return $result;
        }else{
            return false;
        }
    }
    //卡卷优惠价格计算
    public function get_local_coupon_count($data,$coupon)
    {
        //判断卡卷类型
        if($coupon->type == 'pct'){
            $pct = $coupon->pct/100;
            //卡卷状态更改(待添加)


            $data['product_total'] = round($data['product_total'] * $pct,2);
            return $data;
        }else{

        }
    }



}