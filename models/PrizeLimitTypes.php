<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * PrizeLimitTypes is the model the prize limit types.
 *
 * PrizeLimitTypes model
 *
 * @property integer $id
 * @property string $type
 */
class PrizeLimitTypes extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            ['type', 'string'],
        ];
    }

    /**
     * Finds type id by type name
     *
     * @return int
     */
    public static function findByType($type)
    {
        if (Yii::$app->user->isGuest){
            return 0;
        } else {
            if ((is_string($type)) and ( ! empty($type))) {
                $typeResult = PrizeLimitTypes::find()->where(['type' => $type])->one();
                return $typeResult->id;
            } else {
                return 0;
            }
        }
    }
}
