<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Local_customer\controllers;
use fecshop\app\apphtml5\modules\AppfrontController;
use Yii;
use apphtml5\local\local_models\mysqldb\Weixin_user_info;
use fecshop\models\mysqldb\Customer;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class WeixinController extends AppfrontController
{

    public function actionLoginv()
    {
        $url = 'http://apphtml5.syz-max.top/local_customer/weixin/loginv';
        $user_info = Yii::$service->weixin->get_weixin_info($url);
        $username = $user_info['nickname'];
        $wx = new Weixin_user_info();
        $weixin = $wx->find()->where('openid = :openid',[':openid' => $user_info['openid']])->one();
        if(!empty($user_info) && empty($weixin))
        {
            $email = md5(time().rand(0,9))."@qq.com";
            $user = [
                'first_name'    =>$username,
                'last_name'    =>$username,
                'email'        =>$email,
            ];
            $result = $this->registerThirdPartyAccountAndLogin($user, 'weixin');
            if($result)
            {
                //存储用户信息
                $res = $this->getBlock()->save_weixin_info($user_info,$email);
                $this->redirect('http://apphtml5.syz-max.top/local_customer/account/index');
            }

        }else{
            //登录操作

        }
    }


    public function actionGet_weixin_info()
    {
        $url = 'http://apphtml5.syz-max.top/local_customer/weixin/get_weixin_info';
        $code = Yii::$service->weixin->get_weixin_code($url);
        if($code)
        {
            $info = Yii::$service->weixin->get_weixin_detail_info($code);
//            var_dump($info);die;
            if($this->Create_weixin_user($info))
            {
                return $this->redirect('http://apphtml5.syz-max.top/local_customer/account/index');
            }else{
                //登录
                return $this->redirect('http://apphtml5.syz-max.top/local_customer/account/index');
            };
        }
        exit();
    }

    public function Create_weixin_user($data)
    {
        $username = $data['nickname'];
        $wx = new Weixin_user_info();
        $weixin = $wx->find()->where('openid = :openid',[':openid' => $data['openid']])->select('customer_id')->asArray()->one();

        if(!empty($data) && empty($weixin))
        {
            $email = md5(time().rand(0,9))."@qq.com";
            $user = [
                'first_name'   =>$username,
                'last_name'    =>$username,
                'email'        =>$email,
            ];
            $result = $this->registerThirdPartyAccountAndLogin($user, 'weixin');;
            if($result)
            {
                //存储用户信息
                return $this->getBlock()->save_weixin_info($data,$email);
            }
            return false;
        }else{
            //登录操作
            $customer = new Customer();
            $user_info = $customer->find()
                      ->where('id = :cid',[':cid' => $weixin['customer_id']])
                      ->select('email')->asArray()
                      ->one();

            $customer_one = Yii::$service->customer->getUserIdentityByEmail($user_info['email']);
            $loginStatus = \Yii::$app->user->login($customer_one);
            return false;
        }
    }

    //2. 创建第三方用户的账户，密码自动生成
    /**
     * @property  $user | Array ,example:
     * ['first_name' => $first_name,'last_name' => $last_name,'email' => $email,]
     * @property  $type | String 代表第三方登录的名称，譬如google，facebook
     * @return bool
     * 如果用户emai存在，则直接登录，成功后返回true
     * 如果用户不存在，则注册用户，然后直接登录，成功后返回true
     */
    protected function RegisterThirdPartyAccountAndLogin($user, $type)
    {

        // 查看邮箱是否存在
        $email = $user['email'];
        $customer_one = Yii::$service->customer->getUserIdentityByEmail($email);

        if ($customer_one) {
            $loginStatus = \Yii::$app->user->login($customer_one);
            if ($loginStatus) {
                return true;
            }
            // 不存在，注册。
        } else {
            if (!(isset($user['password']) && $user['password'])) {
                $user['password'] = $this->getRandomPassword();
            }
            $registerData = [
                'email'       => $email,
                'firstname'   => $user['first_name'],
                'lastname'    => $user['last_name'],
                'password'    => $user['password'],
                'type'        => $type,
            ];
            $registerStatus = Yii::$service->customer->register($registerData);
            if ($registerStatus) {
                $loginStatus = Yii::$service->customer->login($registerData);
                if ($loginStatus) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * 生成账户密码
     */
    protected function getRandomPassword()
    {
        srand((float) microtime() * 1000000); //create a random number feed.
        $ychar = '0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';
        $list = explode(',', $ychar);
        for ($i = 0; $i < 6; $i++) {
            $randnum = rand(0, 35); // 10+26;
            $authnum .= $list[$randnum];
        }

        return $authnum;
    }



}