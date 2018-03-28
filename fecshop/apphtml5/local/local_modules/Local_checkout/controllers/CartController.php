<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\local\local_modules\Local_checkout\controllers;

use fecshop\app\apphtml5\modules\AppfrontController;
use Yii;
use yii\web\Response;

/**
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */
class CartController extends AppfrontController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
        //Yii::$service->page->theme->layoutFile = 'category_view.php';
    }

    /**
     * @return mixed
     * @author syz
     * 购物车页面
     */
    public function actionIndex(){
        //获取购物车的物品
        $products = Yii::$service->get_cart->getLastData();
//        var_dump($products);die;
        return $this->render($this->action->id,$products);
    }


    /**
     * 把产品加入到购物车.
     */
    public function actionAdd()
    {

        $custom_option = Yii::$app->request->post('custom_option');

        $product_id = Yii::$app->request->post('product_id');
        $qty = Yii::$app->request->post('qty');
        //$custom_option  = \Yii::$service->helper->htmlEncode($custom_option);
        $product_id = \Yii::$service->helper->htmlEncode($product_id);


        $qty = \Yii::$service->helper->htmlEncode($qty);
        $qty = abs(ceil((int) $qty));
        if ($qty && $product_id) {
            if ($custom_option) {
                $custom_option_sku = json_decode($custom_option, true);
            }
            if (empty($custom_option_sku)) {
                $custom_option_sku = null;
            }
            $item = [
                'product_id' => $product_id,
                'qty'        =>  $qty,
                'custom_option_sku' => $custom_option_sku,
            ];
            $innerTransaction = Yii::$app->db->beginTransaction();
            try {
                $addToCart = Yii::$service->cart->addProductToCart($item);
                if ($addToCart) {
                    echo json_encode([
                        'status' => 'success',
                        'items_count' => Yii::$service->cart->quote->getCartItemCount(),
                    ]);
                    $innerTransaction->commit();
                    exit;
                } else {
                    $errors = Yii::$service->helper->errors->get(',');
                    echo json_encode([
                        'status' => 'fail',
                        'content'=> $errors,
                        //'items_count' => Yii::$service->cart->quote->getCartItemCount(),
                    ]);
                    $innerTransaction->rollBack();
                    exit;
                }
            } catch (Exception $e) {
                $innerTransaction->rollBack();
            }
        }
    }

    /**
     * @author syz
     * 更新订单
     */
    public function actionUpdateinfo()
    {
        $item_id = Yii::$app->request->get('item_id');
        $up_type = Yii::$app->request->get('up_type');
        $innerTransaction = Yii::$app->db->beginTransaction();
        try {
            if ($up_type == 'add_one') {
                $status = Yii::$service->cart->addOneItem($item_id);
            } elseif ($up_type == 'less_one') {
                $status = Yii::$service->cart->lessOneItem($item_id);
            } elseif ($up_type == 'remove') {
                $status = Yii::$service->cart->removeItem($item_id);
            }
            if ($status) {
                echo json_encode([
                    'status' => 'success',
                ]);
                $innerTransaction->commit();
            } else {
                echo json_encode([
                    'status' => 'fail',
                ]);
                $innerTransaction->rollBack();
            }
        } catch (Exception $e) {
            $innerTransaction->rollBack();
        }
        exit;
    }


    public function actionSelectone()
    {
        $item_id = Yii::$app->request->get('item_id');
        $checked = Yii::$app->request->get('checked');
        $checked = $checked == 1 ? true : false;
        $innerTransaction = Yii::$app->db->beginTransaction();
        try {
            $status = Yii::$service->cart->selectOneItem($item_id, $checked);
            if ($status) {
                echo json_encode([
                    'status' => 'success',
                ]);
                $innerTransaction->commit();
            } else {
                echo json_encode([
                    'status' => 'fail',
                    'content' => Yii::$service->helper->errors->get(',')
                ]);
                $innerTransaction->rollBack();
            }
        } catch (Exception $e) {
            $innerTransaction->rollBack();
        }
        exit;
    }

    public function actionSelectall()
    {
        $checked = Yii::$app->request->get('checked');
        $checked = $checked == 1 ? true : false;
        $innerTransaction = Yii::$app->db->beginTransaction();
        try {
            $status = Yii::$service->cart->selectAllItem($checked);
//            var_dump($status);die;
            if ($status) {
                echo json_encode([
                    'status' => 'success',
                ]);
                $innerTransaction->commit();
            } else {
                echo json_encode([
                    'status' => 'fail',
                    'content' => Yii::$service->helper->errors->get(',')
                ]);
                $innerTransaction->rollBack();
            }
        } catch (Exception $e) {
            $innerTransaction->rollBack();
        }
        exit;
    }


}