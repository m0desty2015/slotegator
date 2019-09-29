<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\PrizeStatusSend;

class PrizesController extends Controller
{
    public function actionSendGifts()
    {
        $countSend = PrizeStatusSend::getStatus();
        if ($countSend != 0){
            echo "Need send gifts " . $countSend . "\r\n";
            $result = PrizeStatusSend::updateStatus();
            $msg = ($result == 1) ? 'Success send' : 'Error send';
            echo $msg;
        }
    }
}
