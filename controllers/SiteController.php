<?php

namespace app\controllers;

use app\models\Admin;
use Yii;
use app\controllers\common\BaseController;
use yii\data\ActiveDataProvider;

class SiteController extends BaseController
{

    public $defaultAction = 'hello';

    public $except = ['login','hello'];

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionHello()
    {
        echo '你好! ~/~';
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    // 管理员列表
    public function actionListadmin()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Admin::find(),
            'pagination' => [
                'pageSize' => 20
            ],
            'sort' => [
                'defaultOrder' => [
                    'createtime' => SORT_DESC
                ]
            ]
        ]);

        return $this->render('listadmin', ['dataProvider' => $dataProvider]);
    }

    // 登陆
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/site/index');
        }
        $this->layout = false;
        $model = new Admin();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                return $this->redirect('/site/index');
            }
        }
        $model->remember = '1';

        return $this->render('login', ['model' => $model]);
    }

    // 修改
    public function actionUpdateadmin()
    {
        $adminid = Yii::$app->request->get('adminid');
        if (!$adminid) {
            throw new \Exception('参数错误');
        }
        $model = Admin::find()->where(['adminid' => $adminid])->one();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->updateadmin($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
                return $this->refresh();
            }
        }

        $model->adminpass = '';

        return $this->render('reg', ['model' => $model, 'title' => '修改']);
    }

    // 退出登陆
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/site/login']);
    }

    // 注册管理员
    public function actionReg()
    {
        $model = new Admin;

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash('info', '注册成功');
                return $this->refresh();
            }
        }

        return $this->render('reg', ['model' => $model, 'title' => '注册']);
    }

}
