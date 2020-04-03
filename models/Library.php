<?php

namespace app\models;

use yii\db\ActiveRecord;

class Library extends ActiveRecord{
  
  public static function tableName(){
    return 'book';
  }

  public function getRating()
  {
      return [$this->points, $this->votes];
  }
  
  public function setRating()
  {
      return $this;
  }

  public function getGenre(){
    return $this->hasOne(Genre::class, ['ID' => 'ID_genre']);
  }

  
  public function getAuthor(){
    return $this->hasOne(Author::class, ['ID' => 'ID_autor']);
  }

}
