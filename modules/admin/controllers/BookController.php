<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Book;
use app\models\Author;
use app\models\Genre;
use app\models\BookSearch;
use app\models\ImageUpload;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    public function actionSetImage($id)
    {
        $model = new ImageUpload;

        if (Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstance($model, 'image');
            if($model->uploadFile($file, $id))
                return $this->redirect(['view', 'id'=>$id]);
        }
        return $this->render('image', ['model'=>$model]);
    }
    
    public function actionSetGenre($id)
    {
        
        $article = $this->findModel($id);
        $selectedGenre = $article->ID_genre;
        
        $genres = ArrayHelper::map(Genre::find()->all(), 'ID', 'gname');

        if(Yii::$app->request->isPost)
        {
            $genre = Yii::$app->request->post('genre');

            if($article->saveGenre($genre))
                return $this->redirect(['view', 'id'=>$article->ID]);
        }

        return $this->render('genre', [
            'article'=>$article,
            'selectedGenre'=>$selectedGenre,
            'genres'=>$genres   
        ]);
    }
    
    public function actionSetAuthor($id)
    {
        
        $article = $this->findModel($id);

        $selectedAuthor = $article->ID_autor;
        
        $authors = ArrayHelper::map(Author::find()->all(), 'ID', 'Full_name');

        if(Yii::$app->request->isPost)
        {

            $author = Yii::$app->request->post('author');

            if($article->saveAuthor($author))
                return $this->redirect(['view', 'id'=>$article->ID]);
        }

        return $this->render('author', [
            'article'=>$article,
            'selectedAuthor'=>$selectedAuthor,
            'authors'=>$authors   
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
