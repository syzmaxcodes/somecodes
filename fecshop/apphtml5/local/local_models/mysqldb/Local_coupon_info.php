<?php

namespace apphtml5\local\local_models\mysqldb;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Local_coupon_info extends ActiveRecord{
    public static function tableName()
    {
        return '{{%coupon_info}}';
    }


}