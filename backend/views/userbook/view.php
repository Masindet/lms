<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Userbook $model */

$this->title = $model->userBookId;
$this->params['breadcrumbs'][] = ['label' => 'Userbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="userbook-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'userBookId' => $model->userBookId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'userBookId' => $model->userBookId], [
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
            'userBookId',
            'userId',
            'bookId',
            'issuedDate',
            'returnDate',
            'dueDate',
            'status',
        ],
    ]) ?>

</div>
