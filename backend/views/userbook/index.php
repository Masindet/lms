<?php

use common\models\Userbook;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UserbookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Userbooks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userbook-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Userbook', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'userBookId',
            'userId',
            'bookId',
            'issuedDate',
            'returnDate',
            //'dueDate',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Userbook $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'userBookId' => $model->userBookId]);
                 }
            ],
        ],
    ]); ?>


</div>
