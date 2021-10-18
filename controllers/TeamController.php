<?php

namespace app\controllers;

class TeamController extends \yii\rest\ActiveController
{   

    public $modelClass =  'app\models\Team';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
