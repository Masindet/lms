<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $authorId
 * @property string $authorName
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
            [['authorName'], 'required'],
            [['authorName'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'authorId' => 'Author ID',
            'authorName' => 'Author Name',
        ];
    }
}
