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
 * Class Weixin
 * @package fecshop\app\apphtml5\helper
 * Created by shiyongzhe.
 * @link http://www.syz-max.top/
 */
class Weixin
{
//    protected $appid = 'wx91b6d5f4a7729d64';
//    protected $appsecret = 'e7953ec1226677487e2e5c88edd7bf7d';
//    protected $url = 'http://apphtml5.syz-max.top/home/index/index';

    protected $appid;
    protected $appsecret;
    protected $url;

    public function __construct()
    {
//        $url = "http://apphtml5.syz-max.top/local_customer";
        $thirdLogin = Yii::$service->store->thirdLogin;
        $wappid = isset($thirdLogin['weixin']['weixin_app_id']) ? $thirdLogin['weixin']['weixin_app_id'] : '';
        $wappsecret = isset($thirdLogin['weixin']['weixin_app_secret']) ? $thirdLogin['weixin']['weixin_app_secret'] : '';
        $this->appid = $wappid;
        $this->appsecret = $wappsecret;
//        $this->url = $url;
    }

    /**
     * @return mixed|string
     * @author syz
     * 获取微信基础token
     */
    public function get_weixin_token(){
        $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->appsecret;
//        var_dump($token_url);die;
        $token = json_decode($this->urlrequest($token_url));
        return $token->access_token;
    }

    /**
     * @return mixed
     * @author syz
     * 获取微信用户的个人信息
     */
    public function get_weixin_info($url){
        $this->url = $url;
        $redirecturl = urlencode($this->url);
        $snsapi_userInfo_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$redirecturl.'&response_type=code&scope=snsapi_userinfo&state=YQJ#wechat_redirect';
        $code = $_GET['code'];

        if( !isset($code) ){
            header('Location:'.$snsapi_userInfo_url);
        }

        $curl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='.$this->appsecret.'&code='.$code.'&grant_type=authorization_code';
        $content = $this->urlrequest($curl);
        $result = json_decode($content);

        //4.通过access_token和openid拉取用户信息
        $webAccess_token = $result->access_token;
        $openid = $result->openid;
        $token = $this->get_weixin_token();
        $userInfourl = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
//        $userInfourl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$webAccess_token.'&openid='.$openid.'&lang=zh_CN ';

        $recontent = $this->urlrequest($userInfourl);
        $userInfo = json_decode($recontent,true);

        return $userInfo;

    }

    public function get_weixin_code($url)
    {
        $this->url = $url;
        $redirecturl = urlencode($this->url);
        $snsapi_userInfo_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$redirecturl.'&response_type=code&scope=snsapi_userinfo&state=YQJ#wechat_redirect';
        $code = $_GET['code'];

        if( !isset($code) ){
            header('Location:'.$snsapi_userInfo_url);
        }else{
            return $code;
        }
    }

    public function get_weixin_detail_info($code)
    {
        $curl = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='.$this->appsecret.'&code='.$code.'&grant_type=authorization_code';
        $content = $this->urlrequest($curl);
        $result = json_decode($content);

        //4.通过access_token和openid拉取用户信息
        $webAccess_token = $result->access_token;
        $openid = $result->openid;
        $token = $this->get_weixin_token();
        $userInfourl = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
//        $userInfourl = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$webAccess_token.'&openid='.$openid.'&lang=zh_CN ';

        $recontent = $this->urlrequest($userInfourl);
        $userInfo = json_decode($recontent,true);

        return $userInfo;
    }

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

}