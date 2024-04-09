<?php

/**
 * Function to clean quotes from a value
 */
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

error_reporting(0);

/**
 * Function to return asset for themes
 */
if (!function_exists('btheme')) {
    function btheme()
    {
        return asset("themes/admin");
    }
}
/**
 * Function to return asset for themes
 */
if (!function_exists('ftheme')) {
    function ftheme()
    {
        return asset("themes/web");
    }
}

/**
 * Function to clean a value
 */
if (!function_exists('clean')) {
    function clean($value)
    {
        $value = cleanQuotes($value);

        $text = preg_replace(array(
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
        ), array('', '', '', '', '', '', '', ''), $value);
        $value = strip_tags($text);

        $value = trim($value);
        $value = ($value == "") ? null : $value;

        return $value;
    }
}

/**
 *Function to delete old image from text editor content
 */
if (!function_exists('deleteOldImageForTextEditorContent')) {
    function deleteOldImageForTextEditorContent($old_content, $content)
    {
        /**
         *  Delete old image files
         */
        $existing_image_list = [];
        $new_image_list = [];

        // Getting old image links
        preg_match_all('/(?<=src=")[^"]+(?=")/', $old_content, $srcs, PREG_PATTERN_ORDER);
        foreach ($srcs[0] as $src) {
            if (strpos($src, $_SERVER['HTTP_HOST']) == true) {
                $existing_image_list[] = $src;
            }
        }

        // Getting new image links
        preg_match_all('/(?<=src=")[^"]+(?=")/', $content, $srcs, PREG_PATTERN_ORDER);
        foreach ($srcs[0] as $src) {
            if (strpos($src, $_SERVER['HTTP_HOST']) == true) {
                $new_image_list[] = $src;
            }
        }

        // Deleting old image files
        foreach ($existing_image_list as $image) {
            if (!in_array($image, $new_image_list)) {
                $file = explode("pageContent/", $image);
                Storage::delete("pageContent/{$file[1]}");
            }
        }
    }
}

/**
 * Function to clean values in an array
 */
if (!function_exists('cleanArray')) {
    function cleanArray($data, $allowed_keys = [], $skip = [])
    {
        if (count($allowed_keys) > 0) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $allowed_keys)) {
                    unset($data[$key]);
                }
            }
        }

        foreach ($data as $key => $value) {
            if (!in_array($key, $skip)) {
                if (is_array($data[$key])) {
                    $data[$key] = cleanArray($data[$key]);
                } else {
                    $data[$key] = clean($value);
                }
            }
        }

        return $data;
    }
}

/**
 * Function to clean values in an array
 */
if (!function_exists('cleanRequest')) {
    function cleanRequest($rules, $keys, $html_key = [], $skip = [])
    {
        $data = [];
        foreach ($rules as $k => $v) {
            if (!is_array($v)) {
                $v = explode("|", $v);
            }

            // Skip Files
            if (in_array("file", $v) || in_array($k, $skip)) {
                // Skip Null
                if (!is_null($keys->$k)) {
                    $data[$k] = $keys->$k;
                }

                continue;
            }

            if (is_array($keys->$k)) {
                $data[$k] = cleanArray($keys->$k);
            } else {
                if (!in_array($k, $html_key)) {
                    $data[$k] = clean($keys->$k);
                } else {
                    $data[$k] = $keys->$k;
                }
            }
        }

        return $data;
    }
}

/**
 * Function to AES Encrypt text
 */
if (!function_exists('lock')) {
    function lock($string, $key = "YOU-CAN-NEVER-UNLOCK-AGRIAPP")
    {
        // AES-128-CBC needs IV with length 16
        $iv = str_pad(substr($key, 0, 16), 16, "0", STR_PAD_LEFT);

        $res = openssl_encrypt($string, 'aes-128-cbc', $key, 0, $iv);
        $res = bin2hex($res);

        return $res;
    }
}

/**
 ** Function to AES Decrypt text
 */
if (!function_exists('unlock')) {
    function unlock($encrypted, $key = "YOU-CAN-NEVER-UNLOCK-AGRIAPP")
    {
        try {
            $encrypted = pack("H*", $encrypted);

            // AES-128-CBC needs IV with length 16
            $iv = str_pad(substr($key, 0, 16), 16, "0", STR_PAD_LEFT);

            $res = openssl_decrypt($encrypted, 'aes-128-cbc', $key, 0, $iv);
            if ($res == false) {
                return null;
            }
            return $res;
        } catch (\Exception $ex) {
            return null;
        }
    }
}

/**
 ** Function to return constants
 */
if (!function_exists('conf')) {
    function conf($key)
    {
        return config("constant.{$key}");
    }
}

/**
 ** Function to return version for JS & CSS
 */
if (!function_exists('ver')) {
    function ver()
    {
        return config("constant.version");
    }
}