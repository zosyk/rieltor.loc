<div class="row register">
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">

        <?
        $form = \yii\bootstrap\ActiveForm::begin();
        ?>

        <?=$form->field($model,'username') ?>
        <?=$form->field($model,'password')->passwordInput() ?>
        <?=$form->field($model,'rememberMe')->checkbox() ?>

        <br>
        <?=\yii\helpers\Html::submitButton('Login',['class' => 'btn btn-success']) ?>

        <?
        \yii\bootstrap\ActiveForm::end();
        ?>



    </div>

</div>