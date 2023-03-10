<?php

namespace App\Helpers;

use App\Model\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use OjiSatriani\Fungsi;
use setasign\Fpdi\Tcpdf\Fpdi;
use DateTime;
class Help extends Fungsi
{

    public static function menu(): ?array
    {
        if ($menu=Menu::whereKode(explode(".", Route::currentRouteName())[0])->first()) {
            $data=[
                'kode'=>$menu->kode ?? NULL, 'model'=>$menu->detail ? ('App\\Model\\'.$menu->detail['model'] ?? NULL) : NULL,
            ];
        }
        return $data ?? NULL;
    }

    /**
     * @param $extension array //type file yang akan ditampilkan
     * @return array
     */
    public static function listFile($path, $extension): array
    {
        $model=[];
        foreach (File::files($path) as $files) {
            if (in_array($files->getExtension(), $extension)) {
                foreach ($extension as $ext) {
                    $name=str_replace('.'.$ext, '', $files->getFilename());
                    $model[$name]=$name;
                }
            }
        }
        return $model;
    }
    static function lamahari($date1,$date2){
        $earlier = new DateTime($date1);
        $later = new DateTime($date2);
        
       return $later->diff($earlier)->format("%a"); //3

    }

    static function durasitanggal($date1,$date2){
        $tgl1 = date('d',strtotime($date1));
        $tgl2 = date('d',strtotime($date2));
        $bln1 = date('m',strtotime($date1));
        $bln2 = date('m',strtotime($date2));
        $thn = date('Y',strtotime($date2));

        if($bln1 == $bln2){
        $bln = $tgl1 .' s/d '.$tgl2.' '.self::blnindo($bln1).' '.$thn;
        }
        return $bln;
    }
    static function blnindo($bln){
        $bulan_array = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        return $bulan_array[ltrim($bln,0)];
    }
static function tglindo($val)
{

  $waktu = date('Y-m-d', strtotime($val));
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($val));

    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$tanggal $bulan $tahun";
}
public static function time_ago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
  
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
  
    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }
  
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'Baru saja';
  }
    public static function shortDescription($content, $length)
    {
        $sentence=strip_tags($content);
        if (str_word_count($sentence) > $length) {
            $limit_sentence=implode(" ", array_slice(explode(" ", $sentence), 0, $length))." ...";
        }
        return $limit_sentence ?? $sentence;
    }

    public static function formatSizeUnits($binner)
    {
        if ($binner >= 1073741824) {
            $binner=number_format($binner / 1073741824, 2).' GB';
        } elseif ($binner >= 1048576) {
            $binner=number_format($binner / 1048576, 2).' MB';
        } elseif ($binner >= 1024) {
            $binner=number_format($binner / 1024, 2).' KB';
        } elseif ($binner > 1) {
            $binner=$binner.' bytes';
        } elseif ($binner == 1) {
            $binner=$binner.' byte';
        } else {
            $binner='0 bytes';
        }
        return $binner;
    }

    public static function generateSeoURL($string, $wordLimit = 0){ 
        $separator = '-'; 
         
        if($wordLimit != 0){ 
            $wordArr = explode(' ', $string); 
            $string = implode(' ', array_slice($wordArr, 0, $wordLimit)); 
        } 
     
        $quoteSeparator = preg_quote($separator, '#'); 
     
        $trans = array( 
            '&.+?;'                 => '', 
            '[^\w\d _-]'            => '', 
            '\s+'                   => $separator, 
            '('.$quoteSeparator.')+'=> $separator 
        ); 
     
        $string = strip_tags($string); 
        foreach ($trans as $key => $val){ 
            $string = preg_replace('#'.$key.'#iu', $val, $string); 
        } 
     
        $string = strtolower($string); 
     
        return trim(trim($string, $separator)); 
    }
    public function alamatIp()
    {
        $ipaddress = '';
        //($_SERVER['SERVER_NAME'])
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }

}
