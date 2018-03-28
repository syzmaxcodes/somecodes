<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */


namespace apphtml5\local\local_modules\Local_customer\block\weixin;

use fecshop\app\apphtml5\helper\mailer\Email;
use Yii;
use fecshop\models\mysqldb\Customer;
/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Loginv
{
    public function getLastData($param = '')
    {

    }


    public function save_weixin_info($data,$email)
    {
        $customer = new Customer();
        $cid = $customer->find()->where('email = :email',[':email' => $email])->asArray()->one();
        if ($cid) {
            $headimg = serialize("{$data['headimgurl']}");
            $db  = Yii::$app->db;
            $sql = "INSERT INTO `wechat_user` (`openid`, `nickname`, `sex`, `city`, `country`, `province`, `language`, `headimgurl`, `remark`, `privilege`, `customer_id`) VALUES ('{$data["openid"]}','{$data["nickname"]}' , '{$data["sex"]}', '{$data["city"]}', '{$data["country"]}', '{$data["province"]}', '{$data["language"]}', '{$headimg}', '{$data["remark"]}', '{$data["privilege"]}', '{$cid["id"]}')";

            $command = $db->createCommand($sql);
            $res     = $command->query($sql);

            return true;
        } else {
            return false;
        }
        return false;
    }


}
