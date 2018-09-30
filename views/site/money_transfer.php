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
                You won <?= $money; ?>$. You can transfer:
            </div>
            <div class="btn_container">
                <?= Html::beginForm(['/site/transfer', 'id' => 'transfer'], 'post', ['enctype' => 'multipart/form-data']) ?>
                <p>
                    <?= Html::input('text', 'number', '', ['class' => 'form-control', 'placeholder' => 'Input Your bank account number', 'required' => 'required']) ?>
                    <br/>
                    <?= Html::submitButton('TRANSFER TO BANK ACCOUNT', ['class' => 'submit btn btn-large btn-primary']) ?>
                </p>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>
