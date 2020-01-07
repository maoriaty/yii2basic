<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '管理员列表';

$this->params['breadcrumbs'][] = '管理员管理';
$this->params['breadcrumbs'][] = '管理员列表';
?>
<a href="<?=Url::to(['reg'])?>" class="btn btn-primary my-2">添加管理员</a>
<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'adminuser',
        'createtime:date',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('修改', ['updateadmin', 'adminid' => $model->adminid]);
                }
            ]
        ]
    ]
]);