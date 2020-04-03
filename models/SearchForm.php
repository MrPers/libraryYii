<?php

namespace app\models;

use \yii\base\Widget;
use yii\db\ActiveRecord;
use Yii;

class SearchForm extends ActiveRecord  {

  public $keyword;  
  public function rules()
    {
      return [
        ['keyword', 'trim'],
        ['keyword', 'required'],
        ['keyword', 'string', 'min' => 3],
      ];
    }   
    
    
  public static function SelectSearch($name)
  {
    $posts = Library::find() 
    ->innerJoin('genre','genre.ID=book.ID_genre')
    ->innerJoin('author','author.ID=book.ID_autor')
    ->where(['like', 'book.name', "{$name}"])
    ->orWhere(['like', 'author.Full_name', "{$name}"])
    ->all();

    return($posts);
  }

  
  public static function SelectScan($tip, $id)
  {
    $posts = Library::find() 
    ->innerJoin('genre','genre.ID=book.ID_genre')
    ->innerJoin('author','author.ID=book.ID_autor')
    ->where(["{$tip}.ID" => $id])
    ->all();
    
    return($posts);
  }


}
