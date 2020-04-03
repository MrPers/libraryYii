<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $ID
 * @property string $Full_name
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Full_name' => 'Full Name',
        ];
    }
}
