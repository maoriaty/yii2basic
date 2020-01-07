<?php

use yii\widgets\ActiveForm;
use app\assets\LoginAsset;
use yii\helpers\Html;

LoginAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
<?php
$CSS = <<<EOF
.wrap {
    max-width: 500px;
    margin: 40px auto;
    margin-top: 80px;
    padding: 50px 80px;
}
.mt-3 {
    margin-top: 2em;
}
EOF;
$this->registerCss($CSS);
?>
</head>
<body>
<?php $this->beginBody()?>
    <div class="wrap">
    <div class="panel panel-primary">
        <div class="panel-heading">小程序后台登陆</div>
        <div class="panel-body">    
            <?php $form = ActiveForm::begin()?>
                <?=$form->field($model, 'adminuser')->textInput(['placeholder' => '管理员'])->label(false)?>
                <?=$form->field($model, 'adminpass')->passwordInput(['placeholder' => '管理员密码'])->label(false)?>
                <?=$form->field($model, 'remember')->checkBox()?>
                <div class="form-group">
                    <?=Html::submitButton('登陆', ['class' => 'btn btn-primary btn-block mt-3'])?>
                </div>
            <?php ActiveForm::end()?>
        </div>
    </div>
    </div>
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
