<?php

namespace backend\controllers;

use common\models\Book;
use common\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Book models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param int $bookId Book ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($bookId)
    {
        return $this->render('view', [
            'model' => $this->findModel($bookId),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {
        $model = new Book();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->bookPhotoFile = UploadedFile::getInstance($model, 'bookPhotoFile');

            $uploadPath = 'uploads/';

            if (!file_exists($uploadPath)) {

                mkdir($uploadPath, 0755, true); // Create the directory with permissions 0755
            }
            if ($model->validate()) {
                if ($model->bookPhotoFile) {
                    $uniqueIdentifier = time();
                    // $fileName = $model->bookPhotoFile->baseName . '_' . $uniqueIdentifier . '.' . $model->bookPhotoFile->extension;

                    $filePath = $uploadPath . $model->bookPhotoFile->baseName . '_' . $uniqueIdentifier . '.' . $model->bookPhotoFile->extension;

                    if ($model->bookPhotoFile->saveAs($filePath)) {
                        // Update the model's pizzaImage attribute with the file path
                        $model->bookPhoto = $filePath; // Assuming 'pizzaImage' is the attribute in the Pizza model for storing the image path
                    } else {
                        Yii::error('Failed to save the uploaded file.');
                        // Handle the case where the file couldn't be saved
                    }
                } else {
                    Yii::error('No file uploaded.');
                    // Handle the case where no file is uploaded
                }

                // Save the model with the updated image path
                if ($model->save(false)) {
                    return $this->redirect(['view', 'bookId' => $model->bookId]);
                } else {
                    Yii::error('Failed to save the model.');
                    // Handle the case where the model couldn't be saved
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $bookId Book ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($bookId)
    {
        $model = $this->findModel($bookId);

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->bookPhotoFile = UploadedFile::getInstance($model, 'bookPhotoFile'); // Retrieve the uploaded file

            // ... (Your existing directory creation and validation code)

            if ($model->validate()) {
                if ($model->bookPhotoFile) {
                    $uploadPath = 'uploads/';
                    $uniqueIdentifier = time();
                    $filePath = $uploadPath . $model->bookPhotoFile->baseName . '_' . $uniqueIdentifier . '.' . $model->bookPhotoFile->extension;

                    if ($model->bookPhotoFile->saveAs($filePath)) {
                        // Update the model's bookPhoto attribute with the file path
                        $model->bookPhoto = $filePath; // Assuming 'bookPhoto' is the attribute in the Book model for storing the image path
                    } else {
                        Yii::error('Failed to save the uploaded file.');
                        // Handle the case where the file couldn't be saved
                    }
                } else {
                    Yii::error('No file uploaded.');
                    // Handle the case where no file is uploaded
                }

                // Save the model with the updated image path
                if ($model->save(false)) {
                    return $this->redirect(['view', 'bookId' => $model->bookId]);
                } else {
                    Yii::error('Failed to save the model.');
                    // Handle the case where the model couldn't be saved
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $bookId Book ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($bookId)
    {
        $this->findModel($bookId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $bookId Book ID
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($bookId)
    {
        if (($model = Book::findOne(['bookId' => $bookId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
