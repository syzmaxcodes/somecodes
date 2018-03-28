<?php

namespace apphtml5\local\local_models\mysqldb;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Weixin_user_info extends ActiveRecord{
    public static function tableName()
    {
        return '{{%wechat_user}}';
    }

    
    

}