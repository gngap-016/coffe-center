<?php

use App\Models\Category;
use App\Models\Setting;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Route;

date_default_timezone_set('Asia/Jakarta');

// GET SETTING
if (!function_exists('getSettings')) {
    function getSettings()
    {
        return Setting::first();
    }
}
// END GET SETTING

// BADGE
if (!function_exists('getBasicBadge')) {
    // for yes/no or active nonactive
    function getBasicBadge($status = '')
    {
        $statusLabel    = [0 => 'danger', 1 => 'success'];
        $valueLabel     = [0 => 'non-active', 1 => 'active'];
        try {
            $statusLabel[$status];
            return '<span class="badge bg-' . $statusLabel[$status] . '">' . sentenceCase($valueLabel[$status]) . '<span>';
        } catch (\Throwable $th) {
            return '<span class="badge bg-light text-dark">Undifined<span>';
        }
    }
}
// END BADGE

// GET MASTER
if (!function_exists('getCategory')) {
    function getCategory($status = '', $take = '')
    {
        $data = Category::query()->orderBy('name', 'ASC');
        $status == '' ? '' : $data = $data->where('status', $status);
        $take == '' ? '' : $data = $data->take($take);
        return $data->get();
    }
}
// END GET MASTER

if (!function_exists('activeMenu')) {
    function activeMenu($route)
    {
        return strpos(Route::current()->getName(), $route) !== false ? 'active' : '';
    }
}

// ABJAD & NUMERIK
if (!function_exists('unFormatMoney')) {
    function unFormatMoney($money)
    {
        $data = str_replace('.', '', $money);
        return (int) $data;
    }
}
if (!function_exists('numberFormat')) {
    function numberFormat($number, $number_coma = 0, $sparator1 = '.', $sparator2 = ',')
    {
        return number_format($number, $number_coma, $sparator2, $sparator1);
    }
}
if (!function_exists('sentenceCase')) {
    function sentenceCase($text)
    {
        return ucwords($text);
    }
}

if (!function_exists('lowercase')) {
    function lowerCase($text)
    {
        return strtolower($text);
    }
}

if (!function_exists('uppercase')) {
    function upperCase($text)
    {
        return strtoupper($text);
    }
}

if (!function_exists('firstCase')) {
    function firstCase($text)
    {
        return ucfirst($text);
    }
}
// END ABJAD & NUMERIK

// IMAGE
if (!function_exists('imageSquare')) {
    function imageSquare($file, $size)
    {
        // CROP IMAGE CENTER WITH DIMENTION 1:1
        $file = Image::make($file->getRealPath())->fit($size)->encode($file->getClientOriginalExtension(), 100);
        return $file;
    }
}
if (!function_exists('imageConvert')) {
    function imageConvert($file, $size_height, $size_width = 0)
    {
        if ($size_width == 0) {
            // REAL DIMENTION SIZE (NO CROP)
            $file = Image::make($file->getRealPath())
                ->resize($size_height, $size_height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode($file->getClientOriginalExtension(), 100);
            return $file;
        } else {
            // CROP IMAGE WITH NEW SIZE & DIMENTION (CUSTOM)
            $file = Image::make($file->getRealPath())
                ->fit($size_height, $size_width, function ($constraint) {
                    $constraint->upsize();
                })->encode($file->getClientOriginalExtension(), 100);
            return $file;
        }
    }
}
// END IMAGE

// CUSTOM DATE
if (!function_exists('customDate')) {
    function customDate($date, $format)
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        $day = date('d', strtotime($date));
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $date =  $day . ' ' . $months[(int)$month - 1] . ' ' . $year;
        return $date;
    }
}

if (!function_exists('dateTimeFormat')) {
    function dateTimeFormat($date)
    {
        $day = date('d', strtotime($date));
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $date =  $day . ' ' . $months[(int)$month - 1] . ' ' . $year . ' ' . date('H:i', strtotime($date));
        return $date;
    }
}

if (!function_exists('dateFormatDay')) {
    function dateFormatDay($date)
    {
        $day_name = date('D', strtotime($date));
        $day = date('d', strtotime($date));
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $day_names = ['mon' => 'Minggu', 'tue' => 'Selasa', 'wed' => 'Rabu', 'thu' => 'Kamis', 'fri' => 'Jumat', 'sat' => 'Sabtu',];
        $date =  $day_names[strtolower($day_name)] . ', ' . $day . ' ' . $months[(int)$month - 1] . ' ' . $year;
        return $date;
    }
}
// END CUSTOM DATE
