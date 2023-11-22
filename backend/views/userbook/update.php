<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Userbook $model */

$this->title = 'Update Userbook: ' . $model->userBookId;
$this->params['breadcrumbs'][] = ['label' => 'Userbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->userBookId, 'url' => ['view', 'userBookId' => $model->userBookId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="userbook-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
