<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;  // Assuming the User model is in the common\models namespace
use common\models\Book;  // Assuming the Book model is in the common\models namespace


/** @var yii\web\View $this */
/** @var common\models\Userbook $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="userbook-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'issuedDate')->input('date') ?>

    <?= $form->field($model, 'returnDate')->input('date') ?>

    <?= $form->field($model, 'dueDate')->input('date') ?>

    <?= $form->field($model, 'status')->dropDownList(['active' => 'Active', 'returned' => 'Returned', 'overdue' => 'Overdue', 'lost' => 'Lost',], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>