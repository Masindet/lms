<?php

use common\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bookId',
            [
                'attribute' => 'bookPhoto',
                'format' => 'html', // Set the format to HTML
                'value' => function ($model) {
                return Html::img(Yii::$app->request->baseUrl . '/' . $model->bookPhoto, ['width' => '200px']);
                // Assuming 'pizzaImage' contains the image path. Modify this according to your actual attribute name.
                },
            ],
            'bookName',
            [
                'attribute' => 'categoryId',
                'value' => function ($model) {
                    // Assuming you have a 'category' relation in your Book model
                    return $model->category->categoryName;
                },
            ],
            [
                'attribute' => 'authorId',
                'value' => function ($model) {
                    // Assuming you have an 'author' relation in your Book model
                    return $model->author->authorName;
                },
            ],
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'bookId' => $model->bookId]);
                 }
            ],
        ],
    ]); ?>


</div>
