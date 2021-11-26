<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0438bbe35d11dd26a7f5dfcfc57c5af1
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Theme\\LaraMag\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Theme\\LaraMag\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0438bbe35d11dd26a7f5dfcfc57c5af1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0438bbe35d11dd26a7f5dfcfc57c5af1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}