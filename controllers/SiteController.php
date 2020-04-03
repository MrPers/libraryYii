<?php

namespace app\controllers;
use Yii;
use app\models\Genre;
use app\models\Library;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use app\models\SearchForm;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\filters\AccessControl;

class SiteController extends Controller
{

    public function actionIndex()
    {
      $query = Library::find()->with(['genre', 'author']);
      $pages = new Pagination([
        'totalCount' => $query->count(),
        'pageSize' => 4,
        'forcePageParam' => false,
        'pageSizeParam' => false,
      ]);
      $site = $query->offset($pages->offset)->limit($pages->limit)->all();
  
      $genre = Genre::find()->all();
      return $this-> render('index', compact('site', 'genre', 'pages'));
    }
  
    public function actionBook($id)
    {
  
      $genre = Genre::find()->all();
      
      $book =  Library::findOne($id);
      if (empty($book))
      {
        throw new NotFoundHttpException("Страница не найдена.");
        die;
      }
    return $this->render('book',compact('book', 'genre'));

    }  
  
    public function actionScan($tip = 'author', $id = '0'){
  
      $model = new SearchForm();
      $genre = Genre::find()->all();
      if ($model->load(Yii::$app->request->post()))
          $scan = SearchForm::SelectSearch($model["keyword"]);
      else
      {
        $scan = SearchForm::SelectScan($tip, $id);

        if (empty($scan) && $tip != 'author')
        {
          throw new NotFoundHttpException("Страница не найдена.");
          die;
        }
      }
  
      return $this->render('scan', [
      'model' => $model,
      'genre' => $genre,
      'scan' => $scan,
      ]);
  
    }

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
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    // /**
    //  * Login action.
    //  *
    //  * @return Response|string
    //  */
    // public function actionLogin()
    // {
    //     if (!Yii::$app->user->isGuest) {
    //         return $this->goHome();
    //     }

    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         return $this->goBack();
    //     }

    //     $model->password = '';
    //     return $this->render('login', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
