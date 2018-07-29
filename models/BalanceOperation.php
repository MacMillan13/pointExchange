<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operation".
 *
 * @property int $id
 * @property string $sentFrom
 * @property double $howMuch
 * @property string $sentTo
 */
class BalanceOperation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sentFrom', 'howMuch', 'sentTo'], 'required'],
            [['id'], 'integer'],
            [['howMuch'], 'number'],
            [['sentFrom', 'sentTo'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sentFrom' => 'Sent From',
            'howMuch' => 'How Much',
            'sentTo' => 'Sent To',
        ];
    }

    public function counting($result,$a,$b){
        $result = $a + $b;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'sentFrom']);
    }
    public function getUserTo()
    {
        return $this->hasOne(User::className(), ['id' => 'sentTo']);
    }

    public function operation($difference,$sentTo,$sentFrom)
    {

        if (($sentFrom['balance'] - $difference) > -1000 && $difference > 0 && (round($difference, 2) == $difference)
            && $sentFrom['id'] !== $sentTo['id'])
        {
            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();

            try {
                if($sentTo['id'] !== null) {
                    $sentTo->updateCounters(['balance' => $difference]);

                    $sentFrom->updateCounters(['balance' => -$difference]);

                    $transaction->commit();
                }
            }

            catch(\Exception $e) {

                $transaction->rollBack();
                throw $e;
            }
            catch(\Throwable $e) {

                $transaction->rollBack();
            }
        }
        else if(($sentFrom['balance'] - $difference) < -1000)
        {
            Yii::$app->session->setFlash('danger', "Make sure that your balance is not less -1000");
        }
        else if($difference < 0)
        {
            Yii::$app->session->setFlash('danger', "Make sure that your balance is not less 1 point");
        }
        else if (empty($difference)){
            Yii::$app->session->setFlash('warning',"Quantity is empty");
        }
        else if(round($difference, 2) !== $difference)
        {
            Yii::$app->session->setFlash('warning', "Make sure that your balance don't have more decimal places then 2");
        }
        else if($sentFrom['id'] == $sentTo['id'])
        {
            Yii::$app->session->setFlash('danger',"You can't sent money to yourself");
        }
    }

}