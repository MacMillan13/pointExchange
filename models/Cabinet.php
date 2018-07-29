<?php
/**
 * Created by PhpStorm.
 * User: Vladya
 * Date: 29.07.2018
 * Time: 16:00
 */

namespace app\models;

use Yii;
use yii\base\Model;

class Cabinet extends Model
{
    public function articles($sentFrom,$difference,$sentTo)
    {
        if (($sentFrom['balance'] - $difference) > -1000 && $difference > 0 && (round($difference, 2) == $difference)
            && $sentFrom['id'] !== $sentTo['id']) {
            Yii::$app->db->createCommand('INSERT INTO operation (sentFrom,howMuch,sentTo) VALUES (:sentFrom, :howMuch,:sentTo)', [
                'sentFrom' => $sentFrom['id'],
                'howMuch' => $difference,
                'sentTo' => $sentTo['id'],
            ])->execute();
        }
    }
    public function lookOperation()
    {
        $user = User::findOne(Yii::$app->user->id);

        $rows = BalanceOperation::find()
            ->where('sentFrom =:sentFrom', ['sentFrom' => $user['id']])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $rows;
    }
}
