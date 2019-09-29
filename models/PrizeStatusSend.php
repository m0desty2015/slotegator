<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * PrizeStatusSend is the model the prize status send.
 *
 * PrizeStatusSend model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $stamp
 * @property float $sum
 * @property boolean $status
 */
class PrizeStatusSend extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user_id', 'stamp'], 'integer'],
            [['status'], 'boolean'],
        ];
    }

    /**
     * Finds status prize by $userId
     *
     * @return int
     */
    public static function getStatus()
    {
            $prizesCount = self::find()->where(['status' => false])->count();
            return $prizesCount;
    }

    /**
     * Update|insert status by $userId and $sum and $status
     *
     * @return int
     */
    public static function updateStatus($userId = null, $sum = 0, $statusData = false, $stamp = null)
    {
        if (!is_null($userId)) {
            $sendCount = self::find()->where(['user_id' => $userId, 'stamp' => $stamp, 'sum' => $sum])->count();
            if ($sendCount == 0) {
                $status = new PrizeStatusSend();
                $status->user_id = $userId;
                $status->sum = $sum;
                $status->status = $statusData;
                $status->stamp = time();
                $status->save();

                return 1;
            } else {
                $status = self::find()->where(['user_id' => $userId, 'stamp' => $stamp, 'sum' => $sum])->one();
                $status->status = $statusData;
                $status->save();
            }
        } else {
            self::updateAll(['status' => true], 'status = false');
            return 1;
        }

        return 0;

    }
}
