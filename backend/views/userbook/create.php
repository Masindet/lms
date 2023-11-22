<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Userbook $model */

$this->title = 'Create Userbook';
$this->params['breadcrumbs'][] = ['label' => 'Userbooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userbook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
