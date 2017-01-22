<?php

namespace common\models;

use frontend\components\Common;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $id
 * @property string $email
 * @property string $date_subscribe
 */
class Subscribe extends \yii\db\ActiveRecord
{
    const EVENT_NOTIFICATION_ADMIN = 'new-notif-admin';

    public function init()
    {
        $this->on(self::EVENT_NOTIFICATION_ADMIN, [$this, 'notification']);
    }


    public function notification($event)
    {
        $admins = User::find()->where(['roles' => 'admin'])->all();
        foreach ($admins as $admin) {
            Common::sendMail("Notification", 'New subscribe', $admin['email']);
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_subscribe'], 'safe'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'date_subscribe' => 'Date Subscribe',
        ];
    }

    /**
     * @inheritdoc
     * @return SubscribeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscribeQuery(get_called_class());
    }
}
