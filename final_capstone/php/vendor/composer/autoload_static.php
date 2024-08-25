<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit02b4d32dbdff66bc20305032a83b0b4e
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit02b4d32dbdff66bc20305032a83b0b4e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit02b4d32dbdff66bc20305032a83b0b4e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit02b4d32dbdff66bc20305032a83b0b4e::$classMap;

        }, null, ClassLoader::class);
    }
}
