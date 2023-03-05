<?php

namespace App\model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spt extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $casts=[
        'id'=>'string',
    ];
    protected $fillable=[
        'id','no_spt', 'maksud_perjalanan', 'tempat_berangkat', 'tempat_tujuan','angkutan','tanggal_berangkat','tanggal_kembali','tanggal_penetapan','status_spt','pegawai_id','bidang_id'
    ];

    public function laporan()
    {
        return $this->hasMany('App\Model\Laporan');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Model\Pegawai');
    }

    public function bidang()
    {
        return $this->belongsTo('App\Model\Bidang');
    }

    public function spt_pegawai()
    {
        return $this->hasMany('App\Model\SptPegawai');
    }

    public function file_spt()
    {
        return $this->morphOne(File::class, 'morph')->where('name', '=', 'spt');
    }

    public function file_notadinas()
    {
        return $this->morphOne(File::class, 'morph')->where('name', '=', 'notadinas');
    }

    public function file_sppd()
    {
        return $this->morphOne(File::class, 'morph')->where('name', '=', 'sppd');
    }
    
}
