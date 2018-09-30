<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Object result page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="result">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Object result page.
    </p>

    <div class="row">
        <div class="span4">
            <div class="alert alert-success" role="alert">
                You won! To receive the prize, enter your address.
            </div>
            <div class="btn_container">
                <?= Html::beginForm(['/site/obj-result', 'id' => 'object'], 'post', ['enctype' => 'multipart/form-data']) ?>
                <p>
                    <textarea name="adres" rows="6" cols="90" class="textarea" required="required" placeholder="Input your address here"></textarea>
                    <br/>
                    <?= Html::submitButton('Send the prize', ['class' => 'submit btn btn-large btn-primary']) ?>
                </p>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>
