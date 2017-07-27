<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\note;

use Yii;
use yii\base\InvalidParamException;

/**
 * Class Module
 * Example application configuration:
 *
 * ```php
 * 'modules' => [
 *     'note' => [
 *         'class'         => 'yuncms\note\Module',
 *     ],
 * ],
 * ```
 * @package note
 */
class Module extends \yii\base\Module
{
    /**
     * 初始化模块
     */
    public function init()
    {
        parent::init();
        /**
         * 注册语言包
         */
        if (!isset(Yii::$app->i18n->translations['note*'])) {
            Yii::$app->i18n->translations['note*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }
}