<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\note\frontend\assets;

use yii\web\AssetBundle;

/**
 * NoteAsset
 */
class NoteAsset extends AssetBundle
{
    public $sourcePath = '@yuncms/note/frontend/views/assets';

    /**
     * @var array
     */
    public $css = [
        'css/note.css'
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'xutl\fmt\Asset'
    ];
}