<?php

namespace app\controllers;

use app\models\LocalExtracao;
use app\models\Lote;
use app\models\LoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LoteController implements the CRUD actions for Lote model.
 */
class LoteController extends Controller
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
     * Lists all Lote models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LoteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lote model.
     * @param string $codigo_lote Codigo Lote
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codigo_lote)
    {
        return $this->render('view', [
            'model' => $this->findModel($codigo_lote),
        ]);
    }

    /**
     * Creates a new Lote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lote();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'codigo_lote' => $model->codigo_lote]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $localextracao = LocalExtracao::getAllAsArray();

        return $this->render('create', [
            'model' => $model,
            'localextracao' => $localextracao
        ]);
    }

    /**
     * Updates an existing Lote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $codigo_lote Codigo Lote
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($codigo_lote)
    {
        $model = $this->findModel($codigo_lote);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codigo_lote' => $model->codigo_lote]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lote model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $codigo_lote Codigo Lote
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codigo_lote)
    {
        $this->findModel($codigo_lote)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $codigo_lote Codigo Lote
     * @return Lote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codigo_lote)
    {
        if (($model = Lote::findOne(['codigo_lote' => $codigo_lote])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
