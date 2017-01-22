<?php


namespace app\modules\main\controllers;


use common\models\Advert;
use common\models\LoginForm;
use frontend\components\Common;
use frontend\filters\FilterAdvert;
use frontend\models\ContactForm;
use frontend\models\SignupForm;
use yii\base\DynamicModel;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\Response;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;


class MainController extends Controller
{

    public $layout = 'inner';

    public function behaviors()
    {
        return [
            [
                'only' => ['view-advert'],
                'class' => FilterAdvert::className()
            ]
        ];
    }


    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'test' => [
                'class' => 'frontend\actions\TestAction',
            ],
            'page' => [
                'class' => 'yii\web\ViewAction',
                'layout' => 'inner',
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegister()
    {
        $model = new SignupForm();

        if (\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post())) {
                \Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate();
            }
        }

        if ($model->load(\Yii::$app->request->post()) and $model->signup()) {

            \Yii::$app->session->setFlash('success', 'Register success');
        }

        return $this->render('register', compact('model'));     // model => $model
    }


    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {

            $this->goBack();
        }

        return $this->render('login', compact('model'));
    }


    public function actionLogout() {
        \Yii::$app->user->logout();

        $this->goHome();
    }


    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $body = "<div>Body: <b>" . $model->body . "</b></div>";
            $body .= "<div>Email: <b>" . $model->email . "</b></div>";

            \Yii::$app->common->sendMail($model->subject, $body);
            print 'Sent successfully';
            die();
        }

        return $this->render('contact', ['model' => $model]);
    }


    public function actionViewAdvert($id){
        $model = Advert::findOne($id);

        $data = ['name', 'email', 'text'];
        $model_feedback = new DynamicModel($data);
        $model_feedback->addRule('name','required');
        $model_feedback->addRule('email','required');
        $model_feedback->addRule('text','required');
        $model_feedback->addRule('email','email');


        if(\Yii::$app->request->isPost) {
            if ($model_feedback->load(\Yii::$app->request->post()) && $model_feedback->validate()){

                \Yii::$app->common->sendMail('Subject Advert',$model_feedback->text);
            }
        }

        $user = $model->user;
        $images = Common::getImageAdvert($model,false);

        $current_user = ['email' => '', 'username' => ''];

        $coords = str_replace(['(',')'],'',$model->location);

        $coords = explode(',',$coords);


        $coord = new LatLng(['lat' => $coords[0], 'lng' => $coords[1]]);
        $map = new Map([
            'center' => $coord,
            'zoom' => 20,
        ]);

        $marker = new Marker([
            'position' => $coord,
            'title' => Common::getTitleAdvert($model),
        ]);

        $map->addOverlay($marker);

        if(!\Yii::$app->user->isGuest){

            $current_user['email'] = \Yii::$app->user->identity->email;
            $current_user['username'] = \Yii::$app->user->identity->username;

        }

        return $this->render('view_advert',compact('model','model_feedback','user','images','current_user', 'map'));
    }
}

