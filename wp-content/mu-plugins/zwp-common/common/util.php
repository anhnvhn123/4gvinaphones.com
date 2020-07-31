<?php

class ZWPUtil
{
    public static function generateKey($length = 12)
    {
        $password_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $password_chars_count = strlen($password_chars);

        $data = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
        $pin = '';
        for ($n = 0; $n < $length; $n++) {
            $pin .= substr($password_chars, ord(substr($data, $n, 1)) % $password_chars_count, 1);
        }
        return $pin;
    }
}



