<?php


class TypeAdvertValidator extends \yii\validators\Validator
{

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        if(!in_array($value, ['Buy', 'Rent', 'Sale'])){
            $this->addError($model, $attribute, 'Not required value');
        }
    }

}