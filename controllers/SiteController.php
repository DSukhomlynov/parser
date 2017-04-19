<?php

namespace app\controllers;

use app\models\MyList;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\Form;
use app\models\Percentage;
// подключаем Guzzle


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $url = new Form();
        $percentage = Percentage::find()->all();
        $percentage = $percentage[0]->percentage;
        $percentage = $percentage/100;
        $percent = 1+$percentage;
        if ($url->load(Yii::$app->request->post())) {
            $address = ($_POST['Form']['path']);
            $parser = MyList::parsing($address);
            $array = MyList::getAll();

            $currency = 'USD';
            $course[0] = MyList::getCurs($currency);

            $currency = 'EUR';
            $course[1] = MyList::getCurs($currency);

            $currency = 'UAH';
            $course[2] = MyList::getCurs($currency);

            $session = Yii::$app->session;
            $session['logo'] = $parser[0];
            $session['price'] = $parser[2];
            $session['delivery'] = $parser[3];
            $session['percent'] = $percent;


            return $this->render('pars', ['arrayInView' => $array, 'course' => $course, 'parser' => $parser, 'url' => $url, 'percent' => $percent]);
        }
        $parser = 0;
        $array = MyList::getAll();

        $currency = 'USD';
        $course[0] = MyList::getCurs($currency);

        $currency = 'EUR';
        $course[1] = MyList::getCurs($currency);

        $currency = 'UAH';
        $course[2] = MyList::getCurs($currency);

        return $this->render('pars', ['arrayInView' => $array, 'course' => $course, 'parser' => $parser, 'url' => $url, 'percent' => $percent]);
    }

    public function actionCreate()
    {
        $session = Yii::$app->session;
        $parser[0] = $session['logo'];
        $parser[2] = $session['price'];
        $parser[3] = $session['delivery'];
        $percent = $session['percent'];

        $model = new MyList();
        $model->title = $parser[0];
        $model->description = ($parser[2]*$percent)+$parser[3];
        $model->save();

        return $this->redirect(['index']);
    }


    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionView($id)
    {
        $one = MyList::getOne($id);
        return $this->render('view',['one'=>$one]);
    }
}
