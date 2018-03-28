<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_services\index\user_info;
use fecshop\services\Service;
use Yii;

/**
 * Product ProductMysqldb Service δ������
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class UserInfoMysqldb extends Service 
{
    public $numPerPage = 20;
    protected $_userinfoModelName = '\fecshop\models\mysqldb\Customer';
    protected $_userinfoModel;


    public function init(){
        parent::init();
        list($this->_userinfoModelName,$this->_userinfoModel) = \Yii::mapGet($this->_userinfoModelName);
    }

    public function actionDemo_1(){

        return $this->demo2();
    }



}