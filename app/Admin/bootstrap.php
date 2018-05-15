<?php

// PackageManager::load('admin-default')
//    ->css('extend', public_path('packages/sleepingowl/default/css/extend.css'));
Meta::addCss('extended', 'css/custom.css', ['admin-default']);
Meta::addJs('extended', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js', ['admin-default']);
