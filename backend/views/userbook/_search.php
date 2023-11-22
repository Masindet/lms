<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UserbookSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="userbook-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'userBookId') ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'bookId') ?>

    <?= $form->field($model, 'issuedDate') ?>

    <?= $form->field($model, 'returnDate') ?>

    <?php // echo $form->field($model, 'dueDate') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
