<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <? if (!Yii::$app->user->isGuest){ ?>
    <h1>Sent Points</h1>

    <? $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'name')->dropDownList($showName);?>

    <?=$form->field($model,'balance'); ?>

    <div class="row">
        <div class="col-md-12">
        Balance: <?=$sentFromBalance;?>
        </div>
    </div>
    <br>
    <?=Html::submitButton('Sent', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end() ?>
    <? } ?>

    <h2><?= Html::encode($this->title) ?></h2>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'balance',
        ],

    ]); ?>
    <?php Pjax::end(); ?>
</div>
