<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userbook".
 *
 * @property int $userBookId
 * @property int $userId
 * @property int $bookId
 * @property string $issuedDate
 * @property string|null $returnDate
 * @property string $dueDate
 * @property string $status
 *
 * @property Book $book
 * @property User $user
 */
class Userbook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userbook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'bookId', 'issuedDate', 'dueDate'], 'required'],
            [['userId', 'bookId'], 'integer'],
            [['issuedDate', 'returnDate', 'dueDate'], 'safe'],
            [['status'], 'string'],
            [['bookId'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['bookId' => 'bookId']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userBookId' => 'User Book ID',
            'userId' => 'User ID',
            'bookId' => 'Book ID',
            'issuedDate' => 'Issued Date',
            'returnDate' => 'Return Date',
            'dueDate' => 'Due Date',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['bookId' => 'bookId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
