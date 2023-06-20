<?php
return [

    /*
    |--------------------------------------------------------------------------
    | GrandMaster
    |--------------------------------------------------------------------------
    |
    | Untuk Pengaturan standar GrandMaster
    |
    */
    'status_spt'=>[
        '0'=>'Belum Dilihat',
        '1'=>'Sudah Dilihat',
        '2'=>'Diterima',
        '3'=>'Revisi',
        '4'=>'Ditolak'
    ],
    'angka_indo'=>[
        '0'=>'nol',
        '1'=>'satu',
        '2'=>'dua',
        '3'=>'tiga',
        '4'=>'empat',
        '5'=>'lima',
        '6'=>'enam',
        '7'=>'tujuh',
        '8'=>'delapan',
        '9'=>'sembilan',
        '10'=>'sepuluh'
    ],
    'angkutan'=>[
        'darat'=>'Darat',
        'laut'=>'Laut',
        'udara'=>'Udara',
    ],
    'aplikasi' =>   [
                        'nama'          => 'E-SPT',
                        'singkatan'     => 'E_SPT',
                        'daerah'        => 'Kabupaten Bengkalis', // HARUS HURUF BESAR
                        'kota'          => 'Bengkalis',
                        'level'         => 'Kabupaten', // Kabupaten, kota, provinsi (default)
                        'logo'		    => env('APP_URL').'/backend/img/logo/200.png',
                        'favicon'		=> '/backend/img/logo/50.png',
                        'login_versi'   => 1, // 1,2
                        'author'        => 'hamba-allah',
                        'skin'          => 'light-skin', // dark-skin,light-skin
                        'color_skin'    => 'theme-primary', // theme-primary,theme-secondary,theme-danger
                    ],
    'level' => [
                    0 => 'Unknown',
                    1 => 'Root',
    ],
    'url'   =>  [
                    'admin'     => '',
                    'public'    => '',
                ],
    'ukuran' => [
                    'slide' =>  ['width' => 1920, 'height' => 1000,],
                    'wide'  =>  ['width' => 1170, 'height' => 500,],
                    'thumb' =>  ['width' => 700,  'height' => NULL,],
                    'small' =>  ['width' => 450,  'height' => 250,],
                    'xs'    =>  ['width' => 90,   'height' => 90,],
    ],
    'artisan_password'   =>  env('PASSWORD_ARTISAN', FALSE), //password untuk validasi melakukan sintak di command laravel
    'tes_login' =>  [
                        'uname' =>env('LOGIN_UNAME'),
                        'pwd'   =>env('LOGIN_PWD'),
                    ],
    'regex'=>[
        'uuid'=>'regex:/^[a-zA-Z0-9\-\/ ]+$/',
        'text'=>'regex:/^[a-zA-Z0-9\.\-\/\:\"\,\ ]+$/',
        'json'=>'regex:/^[a-zA-Z0-9\.\-\/\:\{\}\(\)\"\,\[\]\_\<\>\&\;\?\!\ ]+$/',
        'file'=>'mimes:pdf,rar,zip',
        'image'=>'mimes:jpg,jpeg,png',
    ],
    'status_pengumuman'=>[
        'danger'=>'Sangat Penting',
        'warning'=>'Penting',
        'primary'=>'Biasa',
    ],
    'kontak'=>[
        'instagram' =>'Instagram',
        'facebook'  =>'Facebook',
        'twitter'   =>'Twitter',
        'youtube'   =>'Youtube',
        'alamat'    =>'Alamat',
        'email'     =>'Email',
        'telp'      =>'Telp',
        'kontak'    =>'Kontak',
        'koordinat' =>'Koordinat',
    ],
    'status_aktif'=>[
        '0' => 'Aktif',
        '1' => 'Tidak Aktif'
    ],
    'jenis_spt'=>[
        'SPT' => 'SPT',
        'SPPD' => 'SPPD',
    ],
    'tingkat_jabatan'=>[
        'B' => 'Tingkat B',
        'C' => 'Tingkat C',
        'D' => 'Tingkat D',
        'E' => 'Tingkat E',
        'F' => 'Tingkat F',
    ],
    'angkutan'=>[
        'Darat' => 'Darat',
        'Laut' => 'Laut',
        'Udara' => 'Udara'
    ],
    'status_foto'=>[
        'galeri'               => '0',
        'slider'               => '1',
    ],
    'penandatangan'=>[
    '0'                      => 'Tidak',
    '1'                      => 'Ya',
    ],
    
];
