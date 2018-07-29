<?php
/**
 * Created by PhpStorm.
 * User: Vladya
 * Date: 29.07.2018
 * Time: 16:00
 */

namespace app\controllers;


use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    /**
     * Login action.
     *
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
//        $signModel = new SignupForm();
//
//        if(Yii::$app->request->isPost)
//        {
//            $signModel->load(Yii::$app->request->post());
//            if($signModel->signup())
//            {
//                return $this->redirect(['site/']);
//            }
//        }

//        return $this->render('signup', ['model'=>$signModel]);
    }

    public function actionTest()
    {
        $user = User::findOne(1);
        Yii::$app->user->login($user);
        if (Yii::$app->user->isGuest){
            echo 'guest';
        }
        else {
            echo 'authent';
        }

    }
    public function actionRedirect()
    {
            return $this->redirect(['site/index']);
    }

}