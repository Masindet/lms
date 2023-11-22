<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category; // Assuming the Category model is in the common\models namespace
use common\models\Author;   // Assuming the Author model is in the common\models namespace

/** @var yii\web\View $this */
/** @var common\models\Book $model */
/** @var yii\widgets\ActiveForm $form */

$categories = ArrayHelper::map(Category::find()->all(), 'categoryId', 'categoryName');
$authors = ArrayHelper::map(Author::find()->all(), 'authorId', 'authorName');

?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>


    <?= $form->field($model, 'bookName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bookPhotoFile')->fileInput() ?>

    <?= $form->field($model, 'categoryId')->dropDownList($categories, ['prompt' => 'Select Category']) ?>

    <?= $form->field($model, 'authorId')->dropDownList($authors, ['prompt' => 'Select Author']) ?>

    <?= $form->field($model, 'status')->dropDownList(['Available' => 'Available', 'Borrowed' => 'Borrowed', 'Lost' => 'Lost'], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
