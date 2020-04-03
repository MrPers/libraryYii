<?php

use app\models\Genre;
namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $ID
 * @property int $ID_autor
 * @property int $ID_genre
 * @property string $name
 * @property string $content
 * @property string $date
 * @property float|null $points
 * @property int|null $votes
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }
    
    public function saveGenre($genres_id)
    {
        $genres = Genre::findOne($genres_id);

        if($genres != null)
        {
            $this->link('genre', $genres);   
            return true;
        }
    }

    public function saveAuthor($authors_id)
    {
        $authors = Author::findOne($authors_id);
        if($authors != null)
        {
            $this->link('author', $authors); 
            return true;
        }
    }

    public function getArticleComments()
    {
        return $this->getComments()->where(['status'=>1])->all();
    }
    
    public function getAuthor()
    {
        // var_dump($this->hasOne(Author::className(), ['ID'=>'ID_autor']));
        return $this->hasOne(Author::className(), ['ID'=>'ID_autor']);
    }

    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['ID'=>'ID_genre']);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_autor', 'ID_genre', 'name', 'content'], 'required'],
            [['ID_autor', 'ID_genre', 'votes'], 'integer'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['points'], 'number'],
            [['name'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ID_autor' => 'Id Autor',
            'ID_genre' => 'Id Genre',
            'name' => 'Name',
            'content' => 'Content',
            'date' => 'Date',
            'points' => 'Points',
            'votes' => 'Votes',
        ];
    }
}
