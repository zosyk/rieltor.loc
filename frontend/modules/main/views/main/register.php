<div class="row register">
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">

        <!--        <input type="text" class="form-control" placeholder="Full Name" name="form_name">-->
        <!--        <input type="text" class="form-control" placeholder="Enter Email" name="form_email">-->
        <!--        <input type="password" class="form-control" placeholder="Password" name="form_phone">-->
        <!--        <input type="password" class="form-control" placeholder="Confirm Password" name="form_phone">-->
        <!---->
        <!--        <button type="submit" class="btn btn-success" name="Submit">Register</button>-->

        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,

        ]); ?>

            <?= $form->field($model, 'username')?>
            <?= $form->field($model, 'email')?>
            <?= $form->field($model, 'password')->passwordInput()?>
            <?= $form->field($model, 'repassword')->passwordInput()?>

            <?= \yii\helpers\Html::submitButton('Register', ['class' => 'btn btn-success'])?>


        <?php $form = \yii\bootstrap\ActiveForm::end(); ?>
    </div>

</div>