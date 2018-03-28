<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\helper;
use Yii;
/**
 * Class Coupon_action
 * @package apphtml5\helper
 * Created by shiyongzhe.
 * @link http://www.syz-max.top/
 * 分享卡卷逻辑处理部分
 */
class Coupon_action extends \common\local_vendor\CouponAuth{

    public function __construct(){
        //获取分享系统参数
        $config = Yii::$app->params['local_config'];
        $this->host = $config['host'];
        $this->options = array('host'=>$this->host,'consumer_key' => $config['consumer_key'], 'consumer_secret' => $config['consumer_secret'], "use_ssl"=>false);
    }
    /**
     * @author syz
     * 获取卡卷信息
     */
    public function get_coupon_info($data){
        $getCouponParams = array(
            "code"     => $data['code'],
            "wcode"    => $data['wcode'],
            "shopcode" => $data['shopcode'],
        );
        $info = $this->getCoupon($getCouponParams);
        return $this->object_array($info);
    }


    /**
     * @param $array
     * @return array
     * @author syz
     *  对象转数组
     */
    function object_array($array) {
        if(is_object($array)) {
            $array = (array)$array;
        } if(is_array($array)) {
            foreach($array as $key=>$value) {
                $array[$key] = $this->object_array($value);
            }
        }
        return $array;
    }

}