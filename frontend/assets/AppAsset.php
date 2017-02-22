<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/layout/page.css',
        'css/layout/panels.less'
    ];
    public $js = [
        'frameworks/LESS/less.js'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}
