<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Money result page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="result">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Money result page.
    </p>

    <div class="row">
        <div class="span4">
            <div class="alert alert-success" role="alert">
                You won <?= $money; ?>$. You can:
            </div>
            <div class="btn_container">
                <p>
                    <button class="btn btn-large btn-primary out" url="/site/transfer"> TRANSFER TO BANK ACCOUNT </button>
                    <button class="btn btn-large btn-primary convert" url="/site/convert"> CONVERT TO BONUS POINTS </button>
                </p>
            </div>
        </div>
    </div>
</div>
