<?php

namespace yuncms\note\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yuncms\note\models\Note;

/**
 * NoteSearch represents the model behind the search form about `yuncms\note\models\Note`.
 */
class NoteSearch extends Note
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'folder_id', 'type', 'size', 'views', 'expired_at', 'created_at', 'updated_at'], 'integer'],
            [['uuid', 'title', 'format', 'content', 'ip'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Note::find();

        $query->orderBy(['id' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'folder_id' => $this->folder_id,
            'type' => $this->type,
            'size' => $this->size,
            'views' => $this->views,
            'expired_at' => $this->expired_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'format', $this->format])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
