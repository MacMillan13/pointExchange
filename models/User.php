<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $balance
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['balance'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'balance' => 'Quantity',
        ];
    }
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {

    }

    public static function findByName($name)
    {
        return User::find()->where(['name' => $name])->one();
    }

    public function create()
    {
        return $this->save(false);
    }

    public function showName()
    {
        $userId = Yii::$app->user->id;

        return User::find()->select(['name', 'id'])->where(['!=','id', $userId])->indexBy('id')->column();
    }
}
