<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Object transfer result page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="result">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Object transfer result page.
    </p>

    <div class="row">
        <div class="span4">
            <div class="alert alert-success" role="alert">
                You prize will be transfer to address in 3 work days.
            </div>
            <div class="btn_container">
                <p>
                    <button class="btn btn-large btn-primary go" url="/site/prizes"> GO TO GAME PAGE </button>
                </p>
            </div>
        </div>
    </div>
</div>
