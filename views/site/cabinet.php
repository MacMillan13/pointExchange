<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="user-index">
    <h1 class="cabinet-h1">History</h1>
    <table class="table-border">
        <tr class="top">
        <td>ID</td>
        <td>Sent from</td>
        <td>How much</td>
        <td>Sent to</td></tr>
        <? foreach ($find as $one) {?>
        <? if ($one->userTo->name ?? ""){ ?>
        <td><?=$one->id; ?></td>
        <td><?=$one->user->name; ?></td>
        <td><?=$one->howMuch; ?></td>
        <td><?=$one->userTo->name?></td>
        <? }?>
        <tr><? } ?></tr>

    </table>
</div>
