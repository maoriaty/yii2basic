<?php
namespace app\models;

use app\models\common\BaseModel;
use Yii;

class Admin extends BaseModel implements \yii\web\IdentityInterface
{
    public $remember;
    public $repass;

    public static function tableName()
    {
        return '{{admin}}';
    }

    public function rules()
    {
        return [
            ['adminuser', 'required', 'message' => '管理员账号不能为空', 'on' => ['reg', 'login', 'update']],
            ['adminuser', 'unique', 'message' => '管理员已存在', 'on' => ['reg']],
            ['adminpass', 'required', 'message' => '管理员密码不能为空', 'on' => ['reg', 'login', 'update']],
            ['adminpass', 'validatepass', 'on' => ['login']],
            ['repass', 'required', 'message' => '重复密码不能为空', 'on' => ['reg', 'update']],
            ['repass', 'compare', 'compareAttribute' => 'adminpass', 'message' => '两次输入密码不一致', 'on' => ['reg', 'update']],
            [['remember', 'adminemail', 'createtime'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'adminuser' => '管理员账号',
            'adminpass' => '管理员密码',
            'remember' => '记住我',
            'repass' => '重复密码',
            'createtime' => '创建时间'
        ];
    }

    // 验证登陆用户名密码
    public function validatepass()
    {
        if (!$this->hasErrors()) {
            $res = self::find()->where(['adminuser' => $this->adminuser])->one();
            if (is_null($res)) {
                $this->addError('adminpass', '管理员账号或密码错误');
                return false;
            }
            if (!Yii::$app->getSecurity()->validatePassword($this->adminpass, $res->adminpass)) {
                $this->addError('adminpass', '管理员账号或密码错误');
            }
        }
    }

    // 返回该用户
    public function getAdmin()
    {
        return self::find()->where(['adminuser' => $this->adminuser])->one();
    }

    // 登陆
    public function login($data)
    {
        $this->scenario = 'login';
        if ($this->load($data) && $this->validate()) {
            $adminuser = $this->getAdmin();
            return Yii::$app->user->login($adminuser, $this->remember ? 24*3600 : 0);
        }
    }

    // 注册
    public function reg($data)
    {
        $this->scenario = 'reg';
        if ($this->load($data) && $this->validate()) {
            $this->adminpass = Yii::$app->getSecurity()->generatePasswordHash($this->adminpass);
            $this->createtime = time();
            if ($this->save(false)) {
                return true;
            }
        }
        return false;
    }

    public function updateadmin($data)
    {
        $this->scenario = 'update';
        if ($this->load($data) && $this->validate()) {
            $this->adminpass = Yii::$app->getSecurity()->generatePasswordHash($this->adminpass);
            if ($this->save(false)) {
                return true;
            }
        }
        return false;
    }

    // 已下是实现user组件的接口
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }
    public function getId()
    {
        return $this->adminid;
    }
    public function getAuthKey()
    {
        return '';
    }
    public function validateAuthKey($authKey)
    {
        return true;
    }
}

