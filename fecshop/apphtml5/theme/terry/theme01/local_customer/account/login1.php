


<?php
$jsOptions = [
    # js config 1
    [
        'options' => [
            'position' =>  'POS_END',
            //	'condition'=> 'lt IE 9',
        ],
        'js'	=>[

        ],
    ],
];
# css config
$cssOptions = [
    # css config 1.
    [
        'css'	=>[
            'css/login.css',
        ],
    ],
];
\Yii::$service->page->asset->jsOptions 	= \yii\helpers\ArrayHelper::merge($jsOptions, \Yii::$service->page->asset->jsOptions);
\Yii::$service->page->asset->cssOptions = \yii\helpers\ArrayHelper::merge($cssOptions, \Yii::$service->page->asset->cssOptions);
\Yii::$service->page->asset->register($this);

?>

<div class="page-group">
    <div class="page page-current">
        <div class="content">
            <div class="phone">
                <input type="number" id="phone" pattern="d{11}" placeholder="请输入您的手机号"/>
            </div>
            <div class="phone">
                <input type="number" id="password" pattern="d{11}" placeholder="请输入您的密码"/>
            </div>
            <div class="login">登录</div>
            <div class="reg-change">
                <p>还没有注册？<a href="#">立即注册</a></p>
                <a href="#">忘记密码？</a>
            </div>
        </div>
    </div>
</div>

