<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = $model->bookId;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>
        <?= Html::a('Update', ['update', 'bookId' => $model->bookId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'bookId' => $model->bookId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'status',
        ],
    ]) ?>

</div>