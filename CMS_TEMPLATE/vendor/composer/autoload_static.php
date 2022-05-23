<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitff275f8a0b5570e60eec0b354e1aa8ad
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitff275f8a0b5570e60eec0b354e1aa8ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitff275f8a0b5570e60eec0b354e1aa8ad::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitff275f8a0b5570e60eec0b354e1aa8ad::$classMap;

        }, null, ClassLoader::class);
    }
}