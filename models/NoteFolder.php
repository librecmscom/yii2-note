<?php

namespace yuncms\note\models;

use Yii;

/**
 * This is the model class for table "{{%note_folder}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 */
class NoteFolder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%note_folder}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('note', 'ID'),
            'user_id' => Yii::t('note', 'User ID'),
            'name' => Yii::t('note', 'Title'),
            'created_at' => Yii::t('note', 'Created At'),
            'updated_at' => Yii::t('note', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return NoteFolderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NoteFolderQuery(get_called_class());
    }
}
