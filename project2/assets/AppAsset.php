<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'styles/main.css',
    ];
    public $js = [
        'scripts/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function init()
    {
        if(\Yii::$app->controller->id == 'admin'){
            $this->depends[] = BootstrapAsset::className();
            $this->depends[] = BootstrapPluginAsset::className();
        }
        parent::init();
    }
}
