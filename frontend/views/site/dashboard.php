<?php

use common\models\Userbook;
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
$totalBooksCount = count($books);

// Get count of books not returned (status is not returned) for all users
$booksNotReturnedCount = Userbook::find()->where(['!=', 'status', 'returned'])->count();

// Get count of books not returned for the currently logged-in user
$userId = Yii::$app->user->id; // Assuming you want the count for the currently logged-in user
$userBooksNotReturnedCount = Userbook::find()
    ->where(['userId' => $userId])
    ->andWhere(['!=', 'status', 'returned'])
    ->count();

// Get count of issued books for the currently logged-in user
$issuedBooksCount = Userbook::find()->where(['userId' => $userId])->count();

?>
<div class="container" style=" margin-top: 16rem">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-6">
            <div class="alert alert-success back-widget-set text-center">
                <svg width="100px" height="100px" viewBox="0 0 24 24"
                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg"
                    version="1.1" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
                    <g transform="translate(0 -1028.4)">
                        <path d="m3 8v2 1 3 1 5 1c0 1.105 0.8954 2 2 2h14c1.105 0 2-0.895 2-2v-1-5-4-3h-18z"
                            transform="translate(0 1028.4)" fill="#16a085" />
                        <path d="m3 1035.4v2 1 3 1 5 1c0 1.1 0.8954 2 2 2h14c1.105 0 2-0.9 2-2v-1-5-4-3h-18z"
                            fill="#ecf0f1" />
                        <path d="m3 1034.4v2 1 3 1 5 1c0 1.1 0.8954 2 2 2h14c1.105 0 2-0.9 2-2v-1-5-4-3h-18z"
                            fill="#bdc3c7" />
                        <path d="m3 1033.4v2 1 3 1 5 1c0 1.1 0.8954 2 2 2h14c1.105 0 2-0.9 2-2v-1-5-4-3h-18z"
                            fill="#ecf0f1" />
                        <path
                            d="m5 1c-1.1046 0-2 0.8954-2 2v1 4 2 1 3 1 5 1c0 1.105 0.8954 2 2 2h2v-1h-1.5c-0.8284 0-1.5-0.672-1.5-1.5s0.6716-1.5 1.5-1.5h12.5 1c1.105 0 2-0.895 2-2v-1-5-4-3-1c0-1.1046-0.895-2-2-2h-4-10z"
                            transform="translate(0 1028.4)" fill="#16a085" />
                        <path d="m8 1v18h1 9 1c1.105 0 2-0.895 2-2v-1-5-4-3-1c0-1.1046-0.895-2-2-2h-4-6-1z"
                            transform="translate(0 1028.4)" fill="#1abc9c" />
                    </g>
                </svg>
                <h3>
                    <?= $totalBooksCount ?>
                </h3>
                Books Listed
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6">
            <div class="alert alert-success back-widget-set text-center">
                <svg fill="red" width="100px" height="100px" viewBox="0 -0.5 25 25" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m11.538 16.444-.211 5.178-.028.31-5.91-.408c-.37-.039-.696-.201-.943-.443-.277-.253-.501-.56-.654-.905l-.007-.017c-.095-.225-.167-.486-.202-.759l-.002-.015c-.009-.085-.014-.184-.014-.284 0-.223.026-.441.074-.65l-.004.019q.106-.521.165-.774c.102-.368.205-.667.324-.959l-.021.059q.239-.647.267-.743 1.099.167 7.164.392zm-5.447-8.245 2.533 5.333-2.068-1.294c-.536.606-1.051 1.269-1.524 1.964l-.044.069c-.352.503-.692 1.08-.986 1.682l-.034.077q-.338.743-.555 1.33c-.104.251-.194.548-.255.856l-.005.031-.056.295-2.673-5.023c-.15-.222-.243-.493-.253-.786v-.003c-.003-.039-.005-.085-.005-.131 0-.19.032-.372.091-.541l-.003.012.112-.253q.495-.886 1.604-2.641l-1.967-1.215zm17.32 7.275-2.641 5.051c-.109.268-.286.49-.509.652l-.004.003c-.172.136-.378.236-.602.286l-.01.002-.253.056q-.999.098-3.081.165l.112 2.311-3.236-5.164 2.971-5.094.098 2.434c.711.083 1.534.131 2.368.131.568 0 1.131-.022 1.687-.065l-.074.005c.875-.058 1.69-.224 2.462-.485l-.068.02zm-11.042-13.002q-.66.886-3.729 6.121l-4.457-2.631-.267-.165 3.166-5.009c.2-.298.49-.521.831-.632l.011-.003c.261-.097.562-.152.876-.152.088 0 .175.004.261.013l-.011-.001c.251.022.483.081.698.171l-.015-.006c.227.092.419.192.601.306l-.016-.009c.218.146.409.299.585.466l-.002-.002q.338.31.507.485t.507.555q.341.38.454.493zm9.216 4.319 2.983 5.108c.122.238.194.519.194.817 0 .09-.007.179-.019.266l.001-.01c-.058.392-.194.744-.393 1.052l.006-.01c-.133.199-.286.371-.461.518l-.004.003c-.158.137-.333.267-.517.383l-.018.01c-.194.115-.42.219-.656.301l-.027.008q-.429.155-.66.225t-.725.197l-.647.165q-.479-1.013-3.729-6.135l4.404-2.744zm-2.012-3.18 1.998-1.168-3.095 5.249-5.897-.281 2.125-1.21c-.355-.933-.71-1.702-1.109-2.443l.054.11c-.348-.671-.701-1.239-1.091-1.779l.028.041q-.485-.655-.908-1.126c-.204-.238-.42-.452-.652-.648l-.008-.007-.239-.183 5.695.014c.047-.005.101-.008.157-.008.24 0 .468.058.668.16l-.008-.004c.217.098.4.234.55.401l.001.002.155.211q.549.854 1.576 2.669z" />
                </svg>
                <h3>
                    <?= $userBooksNotReturnedCount ?>
                </h3>
                Books Not returned
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-6">
            <div class="alert alert-success back-widget-set text-center">
                <svg width="100px" height="100px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"
                    version="1.1">
                    <path style="fill:#B1974D;stroke:#705F2E;stroke-width:3" d="M 22,10 77,2 77,27 22,28 z" />
                    <path style="fill:#B1974D;stroke:#705F2E;stroke-width:3" d="m 34,20 58,-7 0,76 -58,7 z" />
                    <path style="fill:#5B4335;stroke:#2E241F;stroke-width:3;stroke-linejoin:bevel"
                        d="M 34,20 34,96 21,98 7,89 7,12 22,10 7,12 21,22 z" />
                    <path style="fill:#D2D2B3" d="M 10,13 77,3 c 0,0 -2,5 2,7 4,2 9,2 9,2 l -67,9 z" />
                    <path style="fill:none;stroke:#836959;stroke-width:3" d="m 21,23 0,74" />
                </svg>
                <i class="bi bi-journals"></i>
                <h3>
                    <?= $issuedBooksCount ?>
                </h3>
                Issued Books
            </div>
        </div>

    </div>
</div>