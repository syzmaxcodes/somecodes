<?php

/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_services\index;

use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;
use Yii;
use fecshop\services\Service;
/**
 * Product Service is the component that you can get product info from it.
 * @property Image|\fecshop\services\Product\Image $image ,This property is read-only.
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class User_info extends Service
{
    public $customAttrGroup;
    public $categoryAggregateMaxCount; // Yii::$service->product->categoryAggregateMaxCount;
    /**
     * $storagePrex , $storage , $storagePath 为找到当前的storage而设置的配置参数
     * 可以在配置中更改，更改后，就会通过容器注入的方式修改相应的配置值
     */
    public $storage     = 'UserInfoMysqldb';   // 当前的storage，如果在config中配置，那么在初始化的时候会被注入修改
    /**
     * 设置storage的path路径，
     * 如果不设置，则系统使用默认路径
     * 如果设置了路径，则使用自定义的路径
     */
    public $storagePath = '';
    protected $_user_info;
    protected $_defaultAttrGroup = 'default';

    public function init()
    {
        parent::init();
        $currentService = $this->getStorageService($this);
        $this->_user_info = new $currentService();
    }

    public function actiongetUser_info(){
//        var_dump($this->_user_info);
//        return $this->Demo_1();
    }


}