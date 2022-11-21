<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ef444e34a22e2a0cbd9fde11a624bb7
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ef444e34a22e2a0cbd9fde11a624bb7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ef444e34a22e2a0cbd9fde11a624bb7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5ef444e34a22e2a0cbd9fde11a624bb7::$classMap;

        }, null, ClassLoader::class);
    }
}
