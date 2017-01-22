<?php

namespace frontend\actions;

class TestAction extends \yii\base\Action
{
    public $viewName = 'index';

    public function run()
    {
        return $this->controller->render('@frontend/actions/views/'.$this->viewName);
    }

}