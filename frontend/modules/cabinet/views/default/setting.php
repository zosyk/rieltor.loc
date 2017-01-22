<div class="advert-form">

    <? $form = \yii\bootstrap\ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?=\yii\helpers\Html::img(\common\components\UserComponent::getUserImage(Yii::$app->user->id), ['style' => 'width:200px']) ?>

    <?=$form->field($model,'username') ?>
    <?=$form->field($model,'email') ?>
    <?=\yii\helpers\Html::label('Avatar') ?>
    <?=\yii\helpers\Html::fileInput('avatar') ?>
    <br>
    <br>


    <?= \yii\helpers\Html::submitButton('Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    <? \yii\bootstrap\ActiveForm::end() ?>


    </div>