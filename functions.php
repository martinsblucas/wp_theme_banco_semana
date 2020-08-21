<?php

define('APP_DIR', __DIR__ . '/app/');

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\StylesEnqueueController;
use App\Controllers\ScriptsEnqueueController;
use App\Controllers\LocalizeScriptsController;
use App\Controllers\ImgSizesController;
use App\Controllers\PreGetPostsController;
use App\Controllers\AjaxController;
use App\Controllers\FiltersController;
use App\Controllers\RegisterMenusController;

new StylesEnqueueController;
new ScriptsEnqueueController;
new ImgSizesController;
new PreGetPostsController;
new LocalizeScriptsController;
new AjaxController;
new FiltersController;
new RegisterMenusController;