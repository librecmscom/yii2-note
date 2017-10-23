<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\note\models;

use Yii;
use yii\db\ActiveRecord;
use yuncms\collection\models\Collection;

/**
 * Class Note
 * @property integer $id
 * @property integer $user_id
 * @property integer $folder_id
 * @property string $uuid
 * @property boolean $type
 * @property string $title
 * @property string $format
 * @property string $content
 * @property string $ip
 * @property integer $size
 * @property integer $views
 * @property integer $expired_at
 * @property integer $created_at
 * @property integer $updated_at
 */
class Note extends ActiveRecord
{
    const TYPE_PUBLIC = 1;
    const TYPE_PRIVATE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%note}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior'
            ],
            'blameable' => [
                'class' => 'yii\behaviors\BlameableBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                ],
            ],
            'snowflake'=>[
                'class' => 'xutl\snowflake\SnowflakeBehavior',
                'attribute' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new NoteQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['title', 'format', 'content'], 'filter', 'filter' => 'trim'],
            ['size', 'integer'],
            ['type', 'default', 'value' => self::TYPE_PUBLIC],
            ['type', 'in', 'range' => [self::TYPE_PRIVATE, self::TYPE_PUBLIC]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('note', 'Title'),
            'uuid' => Yii::t('note', 'UUID'),
            'type' => Yii::t('note', 'Type'),
            'format' => Yii::t('note', 'Format'),
            'views' => Yii::t('note', 'Views'),
            'content' => Yii::t('note', 'Content'),
            'expired_at' => Yii::t('note', 'Expired At'),
            'created_at' => Yii::t('note', 'Created At'),
            'updated_at' => Yii::t('note', 'Updated At'),
        ];
    }

    /**
     * User Relation
     * @return \yii\db\ActiveQueryInterface
     */
    public function getUser()
    {
        if ($this->user_id) {
            return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'user_id']);
        }
        return null;
    }

    /**
     * Collection Relation
     * @return \yii\db\ActiveQueryInterface
     */
    public function getCollections()
    {
        return $this->hasMany(Collection::className(), ['model_id' => 'id'])->onCondition(['model' => static::className()]);
    }

    /**
     * 是否是公开笔记
     * @return bool
     */
    public function isPublic()
    {
        return $this->type == static::TYPE_PUBLIC;
    }

    /**
     * 是否是作者
     * @return bool
     */
    public function isAuthor()
    {
        return $this->user_id == Yii::$app->user->id;
    }

    /**
     * 设置成允许公共访问
     * @return int
     */
    public function setPublic()
    {
        return $this->updateAttributes(['type' => static::TYPE_PUBLIC]);
    }

    /**
     * 设置成允许公共访问
     * @return int
     */
    public function setPrivate()
    {
        return $this->updateAttributes(['type' => static::TYPE_PRIVATE]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->ip = Yii::$app->request->userIP;
            $this->size = strlen($this->content);
        }
        return parent::beforeSave($insert);
    }

    /**
     * 保存后生成短网址
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->updateAttributes(['uuid' => $this->generateKey()]);
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * 生成key
     */
    protected function generateKey()
    {
        $result = sprintf("%u", crc32($this->id));
        $key = '';
        while ($result > 0) {
            $s = $result % 62;
            if ($s > 35) {
                $s = chr($s + 61);
            } elseif ($s > 9 && $s <= 35) {
                $s = chr($s + 55);
            }
            $key .= $s;
            $result = floor($result / 62);
        }
        return $key;
    }
}