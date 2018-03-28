<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Index\block\index;

use Yii;
use yii\base\InvalidValueException;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Home
{

    public function getLastData()
    {

        return ['name' => 'zhangsan'];
    }

    /**
     * @param $data
     * @return bool
     * @author syz
     * 存入coupon信息
     */
    public function save_coupon_data($data){
        $coupon_db = Yii::$service->User_info->local_coupon_db;
        if(!$coupon_db->find()->where('primary_code = :pcode and wcode = :wcode',[':pcode' => $data['code']['code'],':wcode' => $data['code']['wcode']])->one())
        {
            $coupon_db->primary_code = $data['code']['code'];
            $coupon_db->wcode = $data['code']['wcode'];
            $coupon_db->rules = json_encode($data['code']['rules']);
            $coupon_db->type = json_encode($data['code']['type']);
            $coupon_db->active = json_encode($data['code']['active']);
            $coupon_db->share_user = $data['code']['share_user'];
            $coupon_db->details = json_encode([
                'brand_name' => $data['code']['details']['brand_name'],
                'title' => $data['code']['details']['title'],
                'date_info' => $data['code']['details']['date_info'],
            ]);
            $coupon_db->use_time = date('Y-m-d H:i:s',time());
            if($coupon_db->save()){
                return true;
            }else{
                return false;
            };
        }else{
            return false;
        };
    }


}