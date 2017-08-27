<?php

$ext = !empty(stristr(PHP_OS, 'WIN')) ? '.exe' : '';

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => __DIR__.'/wkhtml/wkhtmltopdf'.$ext,
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => __DIR__.'/wkhtml/wkhtmltoimage'.$ext,
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
