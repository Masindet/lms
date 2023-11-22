<?php

namespace backend\controllers;

use common\models\Userbook;
use common\models\UserbookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserbookController implements the CRUD actions for Userbook model.
 */
class UserbookController extends Controller
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
     * Lists all Userbook models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserbookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Userbook model.
     * @param int $userBookId User Book ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($userBookId)
    {
        return $this->render('view', [
            'model' => $this->findModel($userBookId),
        ]);
    }

    /**
     * Creates a new Userbook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Userbook();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'userBookId' => $model->userBookId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Userbook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $userBookId User Book ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($userBookId)
    {
        $model = $this->findModel($userBookId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userBookId' => $model->userBookId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Userbook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $userBookId User Book ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($userBookId)
    {
        $this->findModel($userBookId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Userbook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $userBookId User Book ID
     * @return Userbook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($userBookId)
    {
        if (($model = Userbook::findOne(['userBookId' => $userBookId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
