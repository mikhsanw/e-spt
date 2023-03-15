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
        'id'=>'string','angkutan'=>'array','perihal_notadinas'=>'array'
    ];
    protected $fillable=[
        'id','no_spt', 'maksud_perjalanan', 'tempat_berangkat', 'tempat_tujuan','angkutan','tanggal_berangkat','tanggal_kembali','tanggal_penetapan','status_spt','perihal_notadinas','pegawai_id','catatan_pimpinan','bidang_id','kegiatan_id'
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
    public function kegiatan()
    {
        return $this->belongsTo('App\Model\Kegiatan');
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
        return $this->MorphMany(File::class, 'morph')->where('name', '=', 'notadinas');
    }

    public function file_sppd()
    {
        return $this->morphOne(File::class, 'morph')->where('name', '=', 'sppd');
    }
    
    public function file()
    {
        return $this->MorphMany(File::class, 'morph');
    }
}
