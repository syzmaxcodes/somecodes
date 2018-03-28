<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Index\controllers;

use fecshop\app\apphtml5\modules\AppfrontController;
use Yii;
use yii\web\Response;
use fecshop\models\mongodb\Product;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class IndexController extends AppfrontController
{

    public function init()
    {
        parent::init();
        //Yii::$service->page->theme->layoutFile = 'category_view.php';
    }

    /**
     * @return mixed
     * @author syz
     * 分享系统链接首页
     */
    public function actionHome(){
//        $url = 'http://apphtml5.syz-max.top/';
//        $user_info = Yii::$service->weixin->get_weixin_info($url);
//        var_dump($user_info);die;
        
        $products = Yii::$service->User_info->get_products->getLastData();
        $n = 1;
        foreach ($products['bestFeaturedProducts'] as $key => $value){
            $products['bestFeaturedProducts'][$key]['n'] = $n;
            $n ++;
            $products['bestFeaturedProducts'][$key]['url'] = '/local_goods_detail/goods/index?_id='.$value['product_id'];
        }
//        var_dump($products);die;
        $code               = $_GET['code'] ? $_GET['code'] : '';
        $wcode              = $_GET['wcode'] ? $_GET['wcode'] : '';
        $shopcode           = $_GET['shopcode'] ? $_GET['shopcode'] : '';
        //获取卡卷的信息
        if(!empty($code) && !empty($wcode) && !empty($shopcode))
        {
            $data = array(
                'code'       => $code,
                'wcode'      => $wcode,
                'shopcode'   => $shopcode,
            );
        }
        //测试
        $data = array(
            'code'       => "7F04B230-0320-1BAD-26AD-6022FEB469C8",
            'wcode'      => "294680347924",
            'shopcode'   => "e528a19b08211a80931c097ec67248ae",
        );
        if($data) {
            //获取卡卷信息
            $coupon = Yii::$service->User_info->Local_coupon;
            $coupon_action = $coupon->get_coupon_info($data);
            if(!empty($coupon_action)){
                $this->getBlock()->save_coupon_data($coupon_action);
                //卡卷信息存入session
                $loca_coupon['code'] = $coupon_action['code']['code'];
                $loca_coupon['wcode'] = $coupon_action['code']['wcode'];
                $loca_coupon['share_user'] = $coupon_action['code']['share_user'];
                $loca_coupon['details'] = $coupon_action['code']['details'];
                $loca_coupon['default_detail'] = $coupon_action['default_detail'];
                $session = Yii::$app->session;
                $session->set('local_coupon',$loca_coupon);
            }
        }
        return $this->render($this->action->id,$products);
    }

    public function actionTest()
    {
        $mongodb = Product::find()->limit(8)->asArray()->all();
        var_dump($mongodb);die;
    }


    //获取商品列表api
    public function actionGet_dsc_goods_list_api()
    {
        $page = $_GET['page'];
        $is_on_sale = $_GET['is_on_sale'];
        $curl = "http://111.231.252.148/api.php?app_key=60A01191-E317-4D86-BB76-7103AB4E2ADD&method=dsc.goods.list.get&page_size=".$page."&format=json";
        $data = $this->urlrequest($curl);
        $data = $this->object_to_array(json_decode($data));

        foreach ($data['info']['list'] as $key => $value)
        {
            $value = (array)$value;
            if($value['is_on_sale'] == $is_on_sale)
            {
                $list[$key]['goods_id'] = $value['goods_id'];
                $list[$key]['cat_id'] = $value['cat_id'];
                $list[$key]['user_id'] = $value['user_id'];
                $list[$key]['market_price'] = $value['market_price'];
                $list[$key]['goods_number'] = $value['goods_number'];
                $list[$key]['promote_price'] = $value['promote_price'];
                $list[$key]['goods_name'] = $value['goods_name'];
            }
        }
        var_dump($list);die;
    }

    //获取单品api
    public function actionGet_dsc_goods_info_api()
    {
        $goods_id = $_GET['goods_id'];

        $curl = "http://111.231.252.148/api.php?app_key=60A01191-E317-4D86-BB76-7103AB4E2ADD&method=dsc.goods.info.get&goods_id=".$goods_id."&format=json";
        $data = $this->urlrequest($curl);
        $data = $this->object_to_array(json_decode($data));
        $goods_info['goods_id'] = $data['info']['goods_id'];
        $goods_info['cat_id'] = $data['info']['cat_id'];
        $goods_info['goods_name'] = $data['info']['goods_name'];
        $goods_info['click_count'] = $data['info']['click_count'];
        $goods_info['goods_number'] = $data['info']['goods_number'];
        $goods_info['market_price'] = $data['info']['market_price'];
        $goods_info['shop_price'] = $data['info']['shop_price'];
        $goods_info['goods_thumb'] = $data['info']['goods_thumb'];

var_dump($goods_info);die;

    }

//    public function actionGet_list()
//    {
//        $curl = "http://111.231.252.148/api.php?app_key=60A01191-E317-4D86-BB76-7103AB4E2ADD&method=dsc.goods.list.get&format=json";
//        $data = $this->urlrequest($curl);
////        $data = $this->object_array($this->urlrequest($curl));
////        $info = object_array($data);
//
//        var_dump(json_decode($data));die;
//    }
//    public function actionGet_list()
//    {
//        $curl = "http://111.231.252.148/api.php?app_key=60A01191-E317-4D86-BB76-7103AB4E2ADD&method=dsc.goods.list.get&format=json";
//        $data = $this->urlrequest($curl);
////        $data = $this->object_array($this->urlrequest($curl));
////        $info = object_array($data);
//
//        var_dump(json_decode($data));die;
//    }
//    public function actionGet_list()
//    {
//        $curl = "http://111.231.252.148/api.php?app_key=60A01191-E317-4D86-BB76-7103AB4E2ADD&method=dsc.goods.list.get&format=json";
//        $data = $this->urlrequest($curl);
////        $data = $this->object_array($this->urlrequest($curl));
////        $info = object_array($data);
//
//        var_dump(json_decode($data));die;
//    }


    //设置网络请求配置
    function urlrequest($curl,$https=true,$method='GET',$data=null){
        //1.创建一个新cURL资源
        $ch = curl_init();
        //2.设置URL和相应的选项
        //要访问的网站
        curl_setopt($ch, CURLOPT_URL, $curl);
        //启用时会将头文件的信息作为数据流输出。
        curl_setopt($ch, CURLOPT_HEADER, false);
        //将curl_exec()获取的信息以字符串返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($https){
            //FALSE 禁止 cURL 验证对等证书（peer's certificate）。
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  //验证主机
        }
        if($method == 'POST'){
            //发送 POST 请求
            curl_setopt($ch, CURLOPT_POST, true);
            //全部数据使用HTTP协议中的 "POST" 操作来发送。
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        //3.抓取URL并把它传递给浏览器
        $content = curl_exec($ch);
        if ($content  === false) {
            return "网络请求出错: " . curl_error($ch);
            exit();
        }
        //4.关闭cURL资源，并且释放系统资源
        curl_close($ch);
        return $content;
    }


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


    function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)($v);
            }
        }
        return $obj;
    }


}