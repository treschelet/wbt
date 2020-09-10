<?php

namespace app\controllers;

use app\models\Video;
use app\providers\VideoProvider;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\ErrorAction;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
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
        /*
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'added' => ['default' => SORT_DESC],
                    'views' => ['default' => SORT_DESC],
                ],
                'defaultOrder' => ['added' => SORT_DESC]
            ],
        ]);
        */
        $dataProvider = new VideoProvider([
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'added' => ['default' => SORT_DESC],
                    'views' => ['default' => SORT_DESC],
                ],
                'defaultOrder' => ['added' => SORT_DESC]
            ],
        ]);

        return $this->render('index', [
            'data' => $dataProvider,
        ]);
    }
}
