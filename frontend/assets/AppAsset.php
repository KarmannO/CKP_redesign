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
        'css/layout/page.scss',
        'frameworks/bootstrap/css/bootstrap.css'
    ];
    public $js = [
        'frameworks/LESS/less.js',
        'frameworks/bootstrap/js/bootstrap.js',
        'js/layout/left_panel.js'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
