<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd88a7d9014b205f046b071fbacc830ac
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PanduanVIP\\WebExtractor\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PanduanVIP\\WebExtractor\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PanduanVIP\\WebExtractor\\GoogleImage' => __DIR__ . '/../..' . '/src/GoogleImage.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd88a7d9014b205f046b071fbacc830ac::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd88a7d9014b205f046b071fbacc830ac::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd88a7d9014b205f046b071fbacc830ac::$classMap;

        }, null, ClassLoader::class);
    }
}