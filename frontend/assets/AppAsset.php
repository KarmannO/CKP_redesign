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
        'frameworks/bootstrap/css/bootstrap.css',
        'frameworks/form_builder/form-builder.css',
        'frameworks/form_builder/form-render.css',
        'frameworks/custom_scrollbar/jquery.mCustomScrollbar.css'
    ];
    public $js = [
        'frameworks/LESS/less.js',
        'frameworks/bootstrap/js/bootstrap.js',
        'frameworks/form_builder/form-builder.js',
        'frameworks/form_builder/form-render.js',
        'frameworks/custom_scrollbar/jquery.mCustomScrollbar.concat.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
