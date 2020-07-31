<?php
define('WIV', 'YwqYNCHHEHo=');

class ZwpEncryption
{

    public static function encrypt($input = null, $key = null)
    {
        $td = mcrypt_module_open(MCRYPT_BLOWFISH, '', MCRYPT_MODE_ECB, '');
        mcrypt_generic_init($td, $key, base64_decode(WIV));

        $data = mcrypt_generic($td, $input);

        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);

        return self::base64UrlsafeEncode($data);
    }

    public static function decrypt($input = null, $key = null)
    {

        $input = self::base64UrlsafeDecode($input);

        $td = mcrypt_module_open(MCRYPT_BLOWFISH, '', MCRYPT_MODE_ECB, '');
        mcrypt_generic_init($td, $key, base64_decode(WIV));

        $data = mdecrypt_generic($td, $input);

        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);

        return preg_replace("/\p{Cc}*$/u", "", rtrim($data, "\0"));
    }


    private static function base64UrlsafeEncode($val)
    {
        $val = base64_encode($val);
        return str_replace(array('+', '/', '='), array('_', '-', '.'), $val);
    }

    private static function base64UrlsafeDecode($val)
    {
        $val = str_replace(array('_', '-', '.'), array('+', '/', '='), $val);
        return base64_decode($val);
    }

}
