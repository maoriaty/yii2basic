<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\widgets\sidebar\SidebarWidget;

AppAsset::register($this);
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
</head>
<body>
<?php $this->beginBody()?>

<div class="wrap">
    <div class="nav-top-main clearfix">
        <a href="#"><span class="glyphicon glyphicon-th-large pull-left toggle-sidebar" aria-hidden="true"></span></a>
        <a href="<?=Url::to(['/site/logout'])?>" class="pull-right">欢迎登陆<?=!empty(Yii::$app->user->identity->adminuser) ? Yii::$app->user->identity->adminuser : ''?>, 退出</a>
    </div>
    <div class="side-bar-main">
        <div class="bread-header">
            <p>图文小程序</p>
        </div>
        <?=SidebarWidget::widget()?>
    </div>

    <div class="content-main">
        <div class="content">
        <?=Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])?>
        <?=Alert::widget()?>
        <?=$content?>
        </div>
    </div>
</div>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
