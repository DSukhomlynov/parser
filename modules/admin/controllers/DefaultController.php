<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii;
use app\models\MyList;
use app\models\Percentage;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $array = MyList::getAll();
        $percentage = Percentage::find()->all();
        return $this->render('index',['model'=>$array,'percentage'=>$percentage]);
    }

    public function actionEditpers()
    {
        $one = Percentage::getOne();

        if($_POST['Percentage']){
            $one->percentage = $_POST['Percentage']['percentage'];

            if($one->validate() && $one->save()){
                return $this->redirect(['index']);
            }
        }
        return $this->render('editpers',['one'=>$one]);
    }

    public function actionEdit($id)
    {
        $one = MyList::getOne($id);

        if($_POST['MyList']){
            $one->title = $_POST['MyList']['title'];
            $one->description = $_POST['MyList']['description'];

//            $one->attributes = $_POST['MyList'];
            if($one->validate() && $one->save()){
                return $this->redirect(['index']);
            }
        }
        return $this->render('edit',['one'=>$one]);
    }

    public function actionCreate()
    {
        $model = new MyList();

        if ($_POST['MyList']){
            $model->title = $_POST['MyList']['title'];
            $model->description = $_POST['MyList']['description'];

//            $model->attributes = $_POST['MyList'];
            if ($model->validate() && $model->save()){
                return $this->redirect(['index']);
            }
        }
        return $this->render('create',['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $model = MyList::getOne($id);
        $model->delete();
        return $this->redirect(['index']);
    }
}
