<?php

namespace app\controllers;

use app\models\User;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AdminController extends \yii\web\Controller
{
    public $layout = 'admin';

    public function behaviors()
    {
    	return [
    		'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
    	];
    }

    public function actionIndex()
    {
        $model = new User();

        return $this->render('index', [
            'users' => User::find()->all(),
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        User::deleteAll(['id' => $id]);

        $this->redirect(['/admin']);
    }

    public function actionCreate()
    {
        $model = new User();

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(\Yii::$app->request->post())) {
            if($model->save()){
                $this->redirect(['/admin/index']);
            }
        }
    }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(\Yii::$app->request->post())) {
            if($model->save()){
                $this->redirect(['/admin/index']);
            }
        }
    }
}
