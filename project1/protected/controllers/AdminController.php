<?php

class AdminController extends Controller
{
    public $layout = 'admin';
    public $statuses = [
        User::STATUS_ACTIVE => 'Активен',
        User::STATUS_BLOCK => 'Заблокирован'
    ];

    public function accessRules()
    {
        return array(
            array('allow',  // позволим всем пользователям выполнять действия 'list' и 'show'
                'actions' => array('index', 'delete', 'create', 'update'),
                'users' => array('admin'),
            ),
        );
    }

    public function actionIndex()
    {
        $model = new User();

        $this->render('index', [
            'users' => User::model()->findAll(),
            'model' => $model
        ]);
    }

    public function actionDelete($id)
    {
        $user = User::model()->findByPk($id);
        $user->delete();

        $this->redirect('/admin');
    }

    public function actionCreate()
    {
        $model = new User();

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $this->redirect('/admin');
            }
        }

        $this->redirect('/admin');
    }

    public function actionUpdate($id)
    {
        $model = User::model()->findByPk($id);

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'update-form'.$id) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $this->redirect('/admin');
            }
        }

        $this->redirect('/admin');
    }
}