<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit702e3653c62be6efa4e9bd9387477b45
{
    public static $files = array (
        '990b2064fc295be6b464454625577348' => __DIR__ . '/..' . '/waughj/test-hash-item/src/TestHashItem.php',
        '7b60086461ccf14e1bd3ba71f3e9533c' => __DIR__ . '/..' . '/waughj/wp-get-image-sizes/src/WPGetImageSizes.php',
        '09ef4a3370760ead893fda985cf312a9' => __DIR__ . '/..' . '/waughj/wp-get-image-sizes/src/WPImageSize.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WaughJ\\WPUploadPicture\\' => 23,
            'WaughJ\\WPUploadImage\\' => 21,
            'WaughJ\\WPThemePicture\\' => 22,
            'WaughJ\\WPThemeOption\\' => 21,
            'WaughJ\\WPThemeImage\\' => 20,
            'WaughJ\\WPPostThumbnail\\' => 23,
            'WaughJ\\VerifiedArguments\\' => 25,
            'WaughJ\\VerifiedArgumentsSameType\\' => 33,
            'WaughJ\\HTMLPicture\\' => 19,
            'WaughJ\\HTMLImage\\' => 17,
            'WaughJ\\HTMLAttribute\\' => 21,
            'WaughJ\\HTMLAttributeList\\' => 25,
            'WaughJ\\FileLoader\\' => 18,
            'WaughJ\\Directory\\' => 17,
        ),
        'S' => 
        array (
            'Spatie\\Url\\' => 11,
            'Spatie\\Macroable\\' => 17,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WaughJ\\WPUploadPicture\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/wp-upload-picture/src',
        ),
        'WaughJ\\WPUploadImage\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/wp-upload-image/src',
        ),
        'WaughJ\\WPThemePicture\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/wp-theme-picture/src',
        ),
        'WaughJ\\WPThemeOption\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/wp-theme-option/src',
        ),
        'WaughJ\\WPThemeImage\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/wp-theme-image/src',
        ),
        'WaughJ\\WPPostThumbnail\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/wp-post-thumbnail/src',
        ),
        'WaughJ\\VerifiedArguments\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/verified-arguments/src',
        ),
        'WaughJ\\VerifiedArgumentsSameType\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/verified-arguments-same-type/src',
        ),
        'WaughJ\\HTMLPicture\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/html-picture/src',
        ),
        'WaughJ\\HTMLImage\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/html-image/src',
        ),
        'WaughJ\\HTMLAttribute\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/html-attribute/src',
        ),
        'WaughJ\\HTMLAttributeList\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/html-attribute-list/src',
        ),
        'WaughJ\\FileLoader\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/file-loader/src',
        ),
        'WaughJ\\Directory\\' => 
        array (
            0 => __DIR__ . '/..' . '/waughj/directory/src',
        ),
        'Spatie\\Url\\' => 
        array (
            0 => __DIR__ . '/..' . '/spatie/url/src',
        ),
        'Spatie\\Macroable\\' => 
        array (
            0 => __DIR__ . '/..' . '/spatie/macroable/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit702e3653c62be6efa4e9bd9387477b45::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit702e3653c62be6efa4e9bd9387477b45::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
