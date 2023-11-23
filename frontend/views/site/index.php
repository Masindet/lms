<?php
/** @var yii\web\View $this */
use yii\helpers\Url;

$this->title = 'Senior Chief Koinange Girls Highschool';

// Define the URL for your background image
$bgImageUrl = Url::to('@web/images/image9.jpg'); // Replace 'background.jpg' with your image file name and path

// Register CSS styles to set the background image for the entire body
$css = <<<CSS
body {
    /* Set the background image */
    background-image: url('$bgImageUrl');
    /* Adjust background properties for display */
    background-size: cover;
    background-position: center;
    /* Add other styles to ensure content visibility */
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif; /* Set your preferred font family */
    /* Additional styles for text color and other elements */
    color: #ffffff; /* Adjust text color */
}
.body-content {
    /* Additional styles for the content container if needed */
    /* Example styles below */
    padding: 50px; /* Adjust as needed */
}
.titleCustom {
    /* Additional styles for the title if needed */
    color: #ffffff; /* Adjust text color */
}
CSS;

// Register the CSS styles
$this->registerCss($css);
?>

<div class="body-content">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-4 titleCustom" style=" margin-top: 8rem">Welcome to the Library</h1>
        <p class="fs-5 fw-light titleCustom">You can browse our books below.</p>
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/site/book']) ?>">View Our Books</a></p>
    </div>
</div>