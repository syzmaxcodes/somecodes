<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace apphtml5\helper;

/**
 * Class Weixin
 * @package fecshop\app\apphtml5\helper
 * Created by shiyongzhe.
 * @link http://www.syz-max.top/
 */
class Common_function
{
    function json_retutn($data,$type){
        $result = [
            'data' => $data,
            'msg' => $type,
        ];
        return json_encode($result);
    }
}