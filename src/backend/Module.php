<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\note\backend;

use Yii;
use yii\base\InvalidParamException;

/**
 * Class Module
 * Example application configuration:
 *
 * ```php
 * 'modules' => [
 *     'note' => [
 *         'class'         => 'yuncms\note\backend\Module',
 *     ],
 * ],
 * ```
 * @package Payment
 */
class Module extends \yii\base\Module
{
    /**
     * @var string the default route of this module. Defaults to `default`.
     * The route may consist of child module ID, controller ID, and/or action ID.
     * For example, `help`, `post/create`, `admin/post/create`.
     * If action ID is not given, it will take the default value as specified in
     * [[Controller::defaultAction]].
     */
    public $defaultRoute = 'note';
}