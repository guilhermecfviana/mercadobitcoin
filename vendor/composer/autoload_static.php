<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf39ccdc744f041c9d90d94d62858f86d
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GuilhermeViana\\MercadoBitcoin\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GuilhermeViana\\MercadoBitcoin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf39ccdc744f041c9d90d94d62858f86d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf39ccdc744f041c9d90d94d62858f86d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
