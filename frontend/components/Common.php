<?php


namespace frontend\components;


use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

class Common extends Component
{

    const EVENT_NOTIFY = 'notify_admin';

    public static function sendMail($subject, $text, $emailFrom = 'anonim.nobody@yandex.ru', $nameFrom = 'Advert')
    {
        if (\Yii::$app->mail->compose()
            ->setFrom(['anonim.nobody@yandex.ru' => 'Advert'])
            ->setTo([$emailFrom => $nameFrom])
            ->setSubject($subject)
            ->setHtmlBody($text)
            ->send()
        ) {
            return true;
        }
    }

    public function notifyAdmin($event)
    {
        print 'Notify Admin';
    }

    public static function getTitleAdvert($data)
    {

        return $data['bedroom'] . ' Bed Rooms and ' . $data['kitchen'] . ' Kitchen Room Aparment on Sale';
    }


    public static function checkIfImagesExist(array $images)
    {
        $base = '/';
        $noImage = 'uploads/no-image.jpg';

        $i = 0;
        foreach ($images as $image) {
            if(!file_exists($image)) {
                $images[$i] = $noImage;
            }
            $images[$i] = $base .$images[$i];
            $i++;
        }

        return $images;
    }


    public static function getImageAdvert($data, $general = true, $original = false)
    {

        $images = [];
        $base = '';
        if ($general) {

            $images[] = $base . 'uploads/adverts/' . $data['id'] . '/general/small_' . $data['general_image'];
        } else {
            $path = \Yii::getAlias("@frontend/web/uploads/adverts/" . $data['id']);
            $files = BaseFileHelper::findFiles($path);

            foreach ($files as $file) {
                if (strstr($file, "small_") && !strstr($file, "general")) {
                    $images[] = $base . 'uploads/adverts/' . $data['id'] . '/' . basename($file);
                }
            }
        }

        return self::checkIfImagesExist($images);
    }


    public static function substr($text, $start = 0, $end = 50)
    {

        return mb_substr($text, $start, $end);
    }

    public static function getType($row)
    {
        return ($row['sold']) ? 'Sold' : 'New';
    }

    public function getUrlAdvert($row){

        return Url::to(['/main/main/view-advert', 'id' => $row['id']]);
    }

}