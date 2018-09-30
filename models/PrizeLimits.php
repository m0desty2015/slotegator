<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * PrizeLimits is the model the prize limits.
 *
 * PrizeLimits model
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property integer $limit
 */
class PrizeLimits extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'limit'], 'required'],
            [['type', 'user_id', 'limit'], 'integer'],
        ];
    }

    /**
     * Finds limit value by type limit
     *
     * @return int
     */
    public static function getLimit($type)
    {
        if (Yii::$app->user->isGuest){
            return 0;
        } else {
            $type = trim(strip_tags($type));
            if ((is_string($type)) and (!empty($type))) {
                $typeId = PrizeLimitTypes::findByType($type);
                if ($typeId != 0) {
                    $limit = PrizeLimits::find()->where(['user_id' => Yii::$app->user->getId(), 'type' => $typeId])->one();
                    if (!$limit){
                        return 0;
                    } else {
                        return $limit->limit;
                    }
                } else {
                    return $typeId;
                }
            } else {
                return 0;
            }
        }
    }

    /**
     * Update|insert limit value by type limit
     *
     * @return int
     */
    public static function updateLimit($type, $newLimit)
    {
        if (Yii::$app->user->isGuest){
            return 0;
        } else {
            $type = trim(strip_tags($type));
            if ((is_string($type)) and (!empty($type))) {
                $typeId = PrizeLimitTypes::findByType($type);
                if ($typeId != 0) {
                    $limit        = PrizeLimits::find()->where([
                        'user_id' => Yii::$app->user->getId(),
                        'type'    => $typeId
                    ])->one();
                    if (!$limit){
                        $limit = new PrizeLimits();
                        $limit->type = $typeId;
                        $limit->user_id = Yii::$app->user->getId();
                    }
                    $limit->limit = $newLimit;
                    $limit->save();
                    return 1;
                } else {
                    return $typeId;
                }
            } else {
                return 0;
            }
        }
    }
}
