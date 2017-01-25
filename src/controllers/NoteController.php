<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\note\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
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
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@'],
                    ]
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
     * 查看笔记页面
     *
     * @param string $key
     *
     * @return string
     */
    public function actionView($key)
    {
        $model = $this->findModel($key);
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $key
     *
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($key)
    {
        if (($model = Note::findOne(['key' => $key])) != null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist');
    }
}