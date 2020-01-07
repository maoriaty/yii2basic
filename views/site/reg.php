<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = $title;

$this->params['breadcrumbs'][] = ['label' => '管理员列表', 'url' => ['listadmin']];
$this->params['breadcrumbs'][] = $this->title;

$CSS = <<<EOF
.reg {
    width: 500px;
    margin: 40px auto;
    padding: 40px;
}
EOF;
$this->registerCss($CSS);
?>

<div class="reg">
    <?php $form = ActiveForm::begin()?>
        <?=$form->field($model, 'adminuser')->textInput(['placeholder' => '管理员姓名'])->label(false)?>
        <?=$form->field($model, 'adminpass')->passwordInput(['placeholder' => '管理员密码'])->label(false)?>
        <?=$form->field($model, 'repass')->passwordInput(['placeholder' => '重复密码'])->label(false)?>
        <div class="form-group">
            <?=Html::submitButton('确定', ['class' => 'btn btn-primary btn-block mt-3'])?>
        </div>
    <?php ActiveForm::end()?>
</div>