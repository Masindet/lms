<?php

use common\models\Userbook;
use common\models\User;

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
    ->where(['!=', 'status', 'returned'])
    ->count();

// Get count of issued books for the currently logged-in user
$issuedBooksCount = Userbook::find()->count();
$users = User::find()->count();
$authors = Author::find()->count();
$categories = Category::find()->count();
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-2">WELCOME TO THE LIBRARY</h1>

        <p class="display-6">TOIL FOR EXCELLENCE</p>

        <!--<p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="alert alert-success back-widget-set text-center">
                    <svg width="100px" height="100px" viewBox="0 0 24 24"
                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg"
                        version="1.1" xmlns:cc="http://creativecommons.org/ns#"
                        xmlns:dc="http://purl.org/dc/elements/1.1/">
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
                    <svg fill="red" width="100px" height="100px" viewBox="0 -0.5 25 25"
                        xmlns="http://www.w3.org/2000/svg">
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
                    <svg fill="#000000" width="100px" height="100px" viewBox="0 0 36 36" version="1.1"
                        preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>users-solid</title>
                        <path class="clr-i-solid clr-i-solid-path-1"
                            d="M12,16.14q-.43,0-.87,0a8.67,8.67,0,0,0-6.43,2.52l-.24.28v8.28H8.54v-4.7l.55-.62.25-.29a11,11,0,0,1,4.71-2.86A6.59,6.59,0,0,1,12,16.14Z" />
                        <path class="clr-i-solid clr-i-solid-path-2"
                            d="M31.34,18.63a8.67,8.67,0,0,0-6.43-2.52,10.47,10.47,0,0,0-1.09.06,6.59,6.59,0,0,1-2,2.45,10.91,10.91,0,0,1,5,3l.25.28.54.62v4.71h3.94V18.91Z" />
                        <path class="clr-i-solid clr-i-solid-path-3"
                            d="M11.1,14.19c.11,0,.2,0,.31,0a6.45,6.45,0,0,1,3.11-6.29,4.09,4.09,0,1,0-3.42,6.33Z" />
                        <path class="clr-i-solid clr-i-solid-path-4"
                            d="M24.43,13.44a6.54,6.54,0,0,1,0,.69,4.09,4.09,0,0,0,.58.05h.19A4.09,4.09,0,1,0,21.47,8,6.53,6.53,0,0,1,24.43,13.44Z" />
                        <circle class="clr-i-solid clr-i-solid-path-5" cx="17.87" cy="13.45" r="4.47" />
                        <path class="clr-i-solid clr-i-solid-path-6"
                            d="M18.11,20.3A9.69,9.69,0,0,0,11,23l-.25.28v6.33a1.57,1.57,0,0,0,1.6,1.54H23.84a1.57,1.57,0,0,0,1.6-1.54V23.3L25.2,23A9.58,9.58,0,0,0,18.11,20.3Z" />
                        <rect x="0" y="0" width="36" height="36" fill-opacity="0" />
                    </svg>
                    <h3>
                        <?= $users ?>
                    </h3>
                    Users
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="alert alert-success back-widget-set text-center">
                    <svg version="1.1" id="Capa_1" width="100px" height="100px" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 964.07 964.07"
                        style="enable-background:new 0 0 964.07 964.07;" xml:space="preserve">
                        <g>
                            <path d="M850.662,877.56c-0.77,0.137-4.372,0.782-10.226,1.831c-230.868,41.379-273.337,48.484-278.103,49.037
        c-11.37,1.319-19.864,0.651-25.976-2.042c-3.818-1.682-5.886-3.724-6.438-4.623c0.268-1.597,2.299-5.405,3.539-7.73
        c1.207-2.263,2.574-4.826,3.772-7.558c7.945-18.13,2.386-36.521-14.51-47.999c-12.599-8.557-29.304-12.03-49.666-10.325
        c-12.155,1.019-225.218,36.738-342.253,56.437l-57.445,45.175c133.968-22.612,389.193-65.433,402.622-66.735
        c11.996-1.007,21.355,0.517,27.074,4.4c3.321,2.257,2.994,3.003,2.12,4.997c-0.656,1.497-1.599,3.264-2.596,5.135
        c-3.835,7.189-9.087,17.034-7.348,29.229c1.907,13.374,11.753,24.901,27.014,31.626c8.58,3.78,18.427,5.654,29.846,5.654
        c4.508,0,9.261-0.292,14.276-0.874c9.183-1.065,103.471-17.67,280.244-49.354c5.821-1.043,9.403-1.686,10.169-1.821
        c9.516-1.688,15.861-10.772,14.172-20.289S860.183,875.87,850.662,877.56z" />
                            <path d="M231.14,707.501L82.479,863.005c-16.373,17.127-27.906,38.294-33.419,61.338l211.087-166.001
        c66.081,29.303,118.866,38.637,159.32,38.637c71.073,0,104.065-28.826,104.065-28.826c-66.164-34.43-75.592-98.686-75.592-98.686
        c50.675,21.424,156.235,46.678,156.235,46.678c140.186-93.563,213.45-296.138,213.45-296.138
        c-14.515,3.99-28.395,5.652-41.475,5.652c-65.795,0-111-42.13-111-42.13l183.144-39.885C909.186,218.71,915.01,0,915.01,0
        L358.176,495.258C295.116,551.344,250.776,625.424,231.14,707.501z" />
                        </g>
                    </svg>
                    <h3>
                        <?= $authors ?>
                    </h3>
                    Authors
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="alert alert-success back-widget-set text-center">
                    <svg width="100px" height="100px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: none;
                                }
                            </style>
                        </defs>
                        <title>categories</title>
                        <path
                            d="M6.76,6l.45.89L7.76,8H12v5H4V6H6.76m.62-2H3A1,1,0,0,0,2,5v9a1,1,0,0,0,1,1H13a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1H9L8.28,4.55A1,1,0,0,0,7.38,4Z"
                            transform="translate(0 0)" />
                        <path
                            d="M22.76,6l.45.89L23.76,8H28v5H20V6h2.76m.62-2H19a1,1,0,0,0-1,1v9a1,1,0,0,0,1,1H29a1,1,0,0,0,1-1V7a1,1,0,0,0-1-1H25l-.72-1.45a1,1,0,0,0-.9-.55Z"
                            transform="translate(0 0)" />
                        <path
                            d="M6.76,19l.45.89L7.76,21H12v5H4V19H6.76m.62-2H3a1,1,0,0,0-1,1v9a1,1,0,0,0,1,1H13a1,1,0,0,0,1-1V20a1,1,0,0,0-1-1H9l-.72-1.45a1,1,0,0,0-.9-.55Z"
                            transform="translate(0 0)" />
                        <path
                            d="M22.76,19l.45.89L23.76,21H28v5H20V19h2.76m.62-2H19a1,1,0,0,0-1,1v9a1,1,0,0,0,1,1H29a1,1,0,0,0,1-1V20a1,1,0,0,0-1-1H25l-.72-1.45a1,1,0,0,0-.9-.55Z"
                            transform="translate(0 0)" />
                        <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1"
                            width="32" height="32" />
                    </svg>
                    <h3>
                        <?= $categories ?>
                    </h3>
                    Categories
                </div>
            </div>

        </div>
    </div>
</div>