<?php

namespace app\modules\main\controllers;

use frontend\components\Common;
use yii\db\Query;
use yii\web\Controller;

/**
 * Default controller for the `main` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "bootstrap";
        $query = new Query();
        $advert_query = $query->from('advert')->orderBy('id desc');
        $command = $advert_query->limit(5);
        $featured = $advert_query->limit(15)->all();

        $result_general = $command->all();
        $count_general = $command->count();
        $recommend_query = $advert_query->where('recommended = 1')->limit(5);
        $recommend = $recommend_query->all();
        $recommend_count = $recommend_query->count();

        return $this->render('index', compact('count_general', 'result_general', 'featured', 'recommend', 'recommend_count'));
    }

    public function actionTest()
    {
        \Yii::$app->locator->cache->set('name','Alex');

        echo \Yii::$app->locator->cache->get('name');
    }

    public function actionService()
    {
        $locator = \Yii::$app->locator;
        $cache = $locator->cache;

        $cache->set('test', 321);

        echo $cache->get('test');
    }

    public function actionEvent()
    {
        $component = \Yii::$app->common;
        $component->on(Common::EVENT_NOTIFY, [$component, 'notifyAdmin']);
        $component->sendMail('alekcandr@gmail.com', "test subject", 'Test body');
    }

    public function actionLoginData()
    {
        echo \Yii::$app->user->identity->email;
    }

}
