<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Local_goods_detail;

use fecshop\app\apphtml5\modules\AppfrontModule;
use Yii;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class Module extends AppfrontModule
{
    public $blockNamespace;

    public function init()
    {
//        echo 2;die;
        // 以下代码必须指定
        $nameSpace = __NAMESPACE__;
        // web controller
        if (Yii::$app instanceof \yii\web\Application) {
            $this->controllerNamespace = $nameSpace . '\\controllers';
            $this->blockNamespace = $nameSpace . '\\block';
        }
//        Yii::$service->page->theme->layoutFile = 'one_step_checkout.php';
        Yii::$service->page->theme->layoutFile = 'local_goods_detail.php';
//        var_dump( Yii::$service->page->theme->layoutFile);die;
        parent::init();
    }
}