<?php
namespace common\local_vendor;
include_once dirname(__FILE__) . "/tmhOAuth/tmhOAuth.php";


class CouponAuth
{
    protected $common_headers = array("Accept" => "application/json");
    protected $host = "";//api访问地址
    protected $options = array();//初始化配置，如consumer_key等

    //错误时存放错误提示
    public $errmsg = "";
    //接口路径
    public $apiPath = array(
        "usecoupon" => "/shop/ordercodeuse/create",
        "getcoupon" => "/shop/couponcode/getinfo",
        "updateorder" => "/shop/couponorder/update",
        "getactives" => "/shop/couponcode/getactives",//获取活动
        'quickusecoupon' => "/shop/ordercodeuse/quickuse",//订单支付转成票券领取时使用，此订单立即完成
        "getuserinfo" => "/shop/billtoshop/getinfo",//绑定用户时，通过申请编码获取用户信息
        "submitbind" => "/shop/billtoshop/submit",//绑定用户时，提交绑定推送到分享系统，表示申请处理中等待审核
        "bindresult" => "/shop/billtoshop/update",//绑定用户时，推送审核结果
    );
    /**
     *初始化
     **/
    public function __construct($host, $consumer_key="", $consumer_secret="")
    {
        $this->host = $host;

        $this->options = array('host'=>$host,'consumer_key' => $consumer_key, 'consumer_secret' => $consumer_secret, "use_ssl"=>false);

    }
    /**
     * 获取所有活动
     **/
    public function agetAllActives($params)
    {
        $url = 'http://'.$this->host.$this->apiPath['getactives'];
        $result = $this->post($url, $params);
        //var_dump($result);
        return $this->makeResult($result);
    }
    /**
     * 获取单个活动
     */
    public function agetActive($params)
    {
        $url = 'http://'.$this->host.$this->apiPath['getactives'];
        $result = $this->post($url, $params);
        //var_dump($result);
        return $this->makeResult($result);
    }
    /**
     *卡券使用
     **/
    public function useCoupon($params)
    {
        $url = 'http://'.$this->host.$this->apiPath['usecoupon'];
        $result = $this->post($url, $params);
        //var_dump($result);
        return $this->makeResult($result);
    }
    /**
     *卡券查询
     **/
    public function getCoupon($params)
    {
//        var_dump($params);die;
        $url = 'http://'.$this->host.$this->apiPath['getcoupon'];
        $result = $this->post($url, $params);
//        var_dump($url);
//        var_dump($result);die;
        return $this->makeResult($result);
    }
    /**
     *修改订单
     **/
    public function updateOrder($params)
    {
        $url = 'http://'.$this->host.$this->apiPath['updateorder'];
        $result = $this->post($url, $params);
        //var_dump($result);
        return $this->makeResult($result);
    }
    /**
     *快速使用并完成订单,用在订单转成票券领取到卡包，此时订单快速完成，不允许退款
     **/
    public function quickUseCoupon($params)
    {
        $url = 'http://'.$this->host.$this->apiPath['quickusecoupon'];
        $result = $this->post($url, $params);
        //var_dump($result);
        return $this->makeResult($result);
    }
    /**
     *用户信息查询
     **/
    public function getUserInfo($params)
    {
        $url = 'http://'.$this->host.$this->apiPath['getuserinfo'];
        $result = $this->post($url, $params);
        //var_dump($result);
        return $this->makeResult($result);
    }
    /**
     *提交绑定申请推送到分享系统
     **/
    public function submitBind($params)
    {
        $url = 'http://'.$this->host.$this->apiPath['submitbind'];
        $result = $this->post($url, $params);
        //var_dump($params);
        return $this->makeResult($result);
    }
    /**
     *绑定结果推送到分享系统
     **/
    public function bindResult($params)
    {
        $url = 'http://'.$this->host.$this->apiPath['bindresult'];
        $result = $this->post($url, $params);
        //var_dump($result);
        return $this->makeResult($result);
    }

    /**
     *统一格式返回数据
     **/
    public function makeResult($result)
    {
        if($result->error)
        {
            $this->errmsg = $result->msg;
//            var_dump($this->errmsg);die;
            return false;
        }
        return $result;
    }
    /**
     *get方式获取
     **/
    public function get($url, $params=array())
    {
        return $this->fetch($url, $params, "GET");
    }
    /**
     *post方式获取
     **/
    public function post($url, $params=array())
    {
        return $this->fetch($url, $params, "POST");
    }
    /**
     *put方式获取
     **/
    public function put($url, $params=array())
    {
        return $this->fetch($url, $params, "PUT");
    }
    /**
     *delete方式获取
     **/
    public function delete($url, $params=array())
    {
        return $this->fetch($url, $params, 'DELETE');
    }
    /**
     *head方式获取
     **/
    public function head($url, $params=array())
    {
        return $this->fetch($url, $params, "HEAD");
    }
    /**
     *访问数据
     **/
    private function fetch($url, $params=array(), $method="GET")
    {
        $tmhOauth = new \common\local_vendor\tmhOAuth\tmhOAuth($this->options);
        $result = $tmhOauth->request($method, $url, $params, true, false, $this->common_headers);
        if($result == 200)
        {
            $array = json_decode($tmhOauth->response['response']);
            return $array;
        }
        else
        {
            //var_dump($tmhOauth);
            return false;
        }
        //var_dump($result);
    }
}