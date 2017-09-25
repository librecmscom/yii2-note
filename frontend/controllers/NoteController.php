<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\note\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\caching\DbDependency;
use yii\caching\TagDependency;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yuncms\note\models\Note;

/**
 * Class NoteController
 * @package yuncms\note\controllers
 */
class NoteController extends Controller
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'pageCache' => [
                'class' => 'yii\filters\PageCache',
                'only' => ['index'],
                'duration' => 24 * 3600 * 365, // 1 year
                'variations' => [
                    Yii::$app->user->id,
                    Yii::$app->language,
                    Yii::$app->request->get('order'),
                    Yii::$app->request->get('page'),
                ],
                'dependency' => [
                    'class' => 'yii\caching\ChainedDependency',
                    'dependencies' => [
                        new TagDependency(['tags' => [Yii::$app->controller->module->id]]),
                        new DbDependency(['sql' => 'SELECT MAX(id) FROM ' . Note::tableName()])
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'print', 'raw','download',],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'set-type', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * 笔记首页
     */
    public function actionIndex()
    {
        $query = Note::find()->active();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->applyOrder(Yii::$app->request->get('order', 'new'));
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * 创建新的笔记
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = New Note();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('note', 'Note created.'));
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * 修改页面
     *
     * @param integer $uuid
     * @return \yii\web\Response|string
     * @throws NotFoundHttpException
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($uuid)
    {
        /** @var Note $model */
        $model = $this->findModel($uuid);
        if ($model->isAuthor()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('note', 'Note updated.'));
                return $this->redirect(['view','uuid'=>$model->uuid]);
            }
            return $this->render('update', ['model' => $model]);
        }
        throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
    }

    /**
     * 设置笔记隐藏或公开
     * @param int $uuid
     * @return \yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionSetType($uuid)
    {
        $model = $this->findModel($uuid);
        if ($model->isAuthor()) {
            if($model->isPublic()){
                $model->setPrivate();
                Yii::$app->getSession()->setFlash('success', Yii::t('note', 'Notes have been made private.'));
                return $this->redirect(['index']);
            } else {
                $model->setPublic();
                Yii::$app->getSession()->setFlash('success', Yii::t('note', 'Notes have been made public.'));
                return $this->redirect(['index']);
            }
        }
        throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
    }

    /**
     * 查看笔记页面
     *
     * @param string $uuid
     *
     * @return string
     */
    public function actionView($uuid)
    {
        $model = $this->findModel($uuid);
        if ($model && ($model->isPublic() || $model->isAuthor())) {
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('success', Yii::t('note', 'Note does not exist.'));
            return $this->redirect(['index',]);
        }
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $uuid
     *
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionDelete($uuid)
    {
        $model = $this->findModel($uuid);
        if ($model->isAuthor()) {
            $model->delete();
            Yii::$app->getSession()->setFlash('success', Yii::t('note', 'Note has been deleted'));
            return $this->redirect(['index']);
        }
        throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
    }

    /**
     * 获取打印
     * @param string $uuid
     * @return string|Response
     */
    public function actionPrint($uuid)
    {
        $model = $this->findModel($uuid);
        if ($model && ($model->isPublic() || $model->isAuthor())) {
            return $this->render('print', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('success', Yii::t('note', 'Note does not exist.'));
            return $this->redirect(['index']);
        }
    }

    /**
     * 获取原始笔记
     * @param string $uuid
     * @return string|Response
     */
    public function actionRaw($uuid)
    {
        $model = $this->findModel($uuid);
        if ($model && ($model->isPublic() || $model->isAuthor())) {
            Yii::$app->response->format = Response::FORMAT_RAW;
            return $model->content;
        } else {
            Yii::$app->session->setFlash('success', Yii::t('note', 'Note does not exist.'));
            return $this->redirect(['index']);
        }
    }

    /**
     * 下载原始笔记
     * @param string $uuid
     * @return string|Response
     */
    public function actionDownload($uuid)
    {
        $model = $this->findModel($uuid);
        if ($model && ($model->isPublic() || $model->isAuthor())) {
            return Yii::$app->response->sendContentAsFile($model->content, $model->title);
        } else {
            Yii::$app->session->setFlash('success', Yii::t('note', 'Note does not exist.'));
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $uuid
     *
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($uuid)
    {
        if (($model = Note::findOne(['uuid' => $uuid])) != null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist');
    }
}