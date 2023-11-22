<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $bookId
 * @property string $bookPhoto
 * @property string $bookName
 * @property int $categoryId
 * @property int $authorId
 * @property string $status
 *
 * @property Author $author
 * @property Category $category
 * @property Userbook[] $userbooks
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

    public $bookPhotoFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bookName', 'categoryId', 'authorId'], 'required'],
            [['categoryId', 'authorId'], 'integer'],
            [['status'], 'string'],
            [['bookPhoto'], 'string', 'max' => 100],
            [['bookName'], 'string', 'max' => 50],
            [['authorId'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['authorId' => 'authorId']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['categoryId' => 'categoryId']],
            [['bookPhotoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bookId' => 'Book ID',
            'bookPhoto' => 'Book Photo',
            'bookName' => 'Book Name',
            'categoryId' => 'Category ID',
            'authorId' => 'Author ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['authorId' => 'authorId']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['categoryId' => 'categoryId']);
    }

    /**
     * Gets query for [[Userbooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserbooks()
    {
        return $this->hasMany(Userbook::class, ['bookId' => 'bookId']);
    }
}
