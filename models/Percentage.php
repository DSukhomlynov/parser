<?php
/**
 * Created by PhpStorm.
 * User: Dmytro
 * Date: 19.04.2017
 * Time: 21:33
 */

namespace app\models;

use yii\db\ActiveRecord;


class Percentage extends ActiveRecord
{
    public static function getOne()
    {
        $id = 0;
        $data = self::find()->where(['id'=>$id])->one();
        return $data;
    }

    public function rules()
    {
        return [
            [['percentage'], 'required'],
            [['percentage'], 'number', 'min' => 0, 'max' => 1000],
        ];
    }

}