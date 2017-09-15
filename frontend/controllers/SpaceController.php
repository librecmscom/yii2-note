<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\note\frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yuncms\note\models\Note;
use yuncms\collection\models\Collection;
use yuncms\user\models\User;

class SpaceController extends Controller
{
    public $defaultAction = 'started';

    /**
     * 发布的文章
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionStarted($id)
    {
        $user = $this->findModel($id);
        $query = Note::find()->where(['user_id' => $id])->orderBy(['created_at' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('started', [
            'user' => $user,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * 收藏的文章
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCollected($id)
    {
        $user = $this->findModel($id);
        $query = Note::find()->innerJoinWith([
            'collections' => function ($query) use ($id) {
                /** @var \yii\db\ActiveQuery $query */
                $query->where([
                    Collection::tableName() . '.user_id' => $id]);
            }
        ])->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('collected', [
            'user' => $user,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('yii', 'The requested page does not exist.'));
        }
    }
}