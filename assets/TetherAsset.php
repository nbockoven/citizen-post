<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Tether js files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TetherAsset extends AssetBundle
{
    public $sourcePath = '@bower/tether/dist';
    public $css = [
        'css/tether.min.css',
        'css/tether-theme-arrows.min.css',
    ];
    public $js = [
        'js/tether.min.js',
    ];
}
