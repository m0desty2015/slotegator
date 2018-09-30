<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Prizes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="result">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Prizes page.
    </p>
    <div>User loyalty account: <span id="userBalance"><?= $user->balance; ?></span></div>

    <div class="row">
        <div class="span4">
            <div class="roulette_container">
                <div class="roulette" style="display:none;">
                    <img number="0" typePrize="money" src="/images/coin.png"/>
                    <img number="1" typePrize="obj" src="/images/smartphone.png"/>
                    <img number="2" typePrize="obj" src="/images/snickers.png"/>
                    <img number="3" typePrize="money" src="/images/coin.png"/>
                    <img number="4" typePrize="bonus" src="/images/bonus.png"/>
                    <img number="5" typePrize="obj" src="/images/tshirt.png"/>
                    <img number="6" typePrize="obj" src="/images/smartphone.png"/>
                    <img number="7" typePrize="obj" src="/images/snickers.png"/>
                    <img number="8" typePrize="money" src="/images/coin.png"/>
                    <img number="9" typePrize="bonus" src="/images/bonus.png"/>
                    <img number="10" typePrize="obj" src="/images/tshirt.png"/>
                    <img number="11" typePrize="obj" src="/images/smartphone.png"/>
                    <img number="12" typePrize="obj" src="/images/snickers.png"/>
                    <img number="13" typePrize="money" src="/images/coin.png"/>
                    <img number="14" typePrize="bonus" src="/images/bonus.png"/>
                    <img number="15" typePrize="obj" src="/images/tshirt.png"/>
                </div>
            </div>
            <div class="btn_container">
                <p>
                    <button class="btn btn-large btn-primary start"> START </button>
                </p>
            </div>
        </div>
    </div>
</div>
