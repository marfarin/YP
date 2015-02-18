<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of JsAsset
 *
 * @author stager3
 */
class JsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $js = [
        'js/jstree/_lib/jquery.cookie.js',
        'js/jstree/_lib/jquery.hotkeys.js',
        'js/jstree/jquery.jstree.js',
        'js/jstree/rubricsTree.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
