<?php
namespace app\controllers\common;

use app\models\Admin;
use yii\web\Controller;

class BaseController extends Controller
{
    protected $actions = ['*'];
    protected $except = [];
    protected $mustlogin = [];
    protected $verbs = [];


    public function behaviors()
    {

        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => $this->actions, // 针对哪些方法有效，默认所有
                'except' => $this->except, // 针对哪些方法不进行控制
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => empty($this->mustlogin) ? [] : $this->mustlogin,
                        'roles' => ['?'] // 未登录用户默认均不可访问
                    ],
                    [
                        'allow' => true,
                        'actions' => empty($this->mustlogin) ? [] : $this->mustlogin,
                        'roles' => ['@'] // 登陆用户默认均可访问
                    ]
                ]
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => $this->verbs, // 针对某些方法限制其访问方式
            ]

        ];
    }


}