<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;  // Assuming the User model is in the common\models namespace
use common\models\Author;  // Assuming the User model is in the common\models namespace
use common\models\Book;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Senior Chief Koinange Girls Highschool';
$books = Book::find()->all();
$categories = ArrayHelper::map(Category::find()->all(), 'categoryId', 'categoryName');

?>
<div class="container">
    <div class="row">
        <?php foreach ($books as $book): ?>
            <div class="col-md-3 col-sm-2 col-lg-4">
                <div class="card" style="width: 18rem; margin-top: 8rem">
                    <!-- Assuming 'bookCover' is the attribute in the Book model for storing the book cover path -->

                    <img src="<?= Html::encode(Url::to('/lms/backend/web/' . $book->bookPhoto)) ?>" class="card-img-top"
                        alt="<?= Html::encode($book->bookName) ?>">


                    <div class="card-body">
                        <h5 class="card-title">
                            <?= Html::encode($book->bookName) ?>
                        </h5>
                        <?php
                        $category = Category::findOne($book->categoryId);
                        $author = Author::findOne($book->authorId);

                        ?>
                        <p class="card-text">
                            <?= Html::encode($category->categoryName) ?>
                        </p>
                        <p class="card-text">
                            <?= Html::encode($author->authorName) ?>
                        </p>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>