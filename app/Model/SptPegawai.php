<?php

namespace App\model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SptPegawai extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $casts=[
        'id'=>'string',
    ];
    protected $fillable=[
        'id', 'no_sppd', 'status_dibaca','spt_id', 'pegawai_id','bidang_id','jabatan_id'
    ];

    public function spt()
    {
        return $this->belongsTo('App\Model\Spt');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Model\Pegawai');
    }
    
    public function file_sppd()
    {
        return $this->morphOne(File::class, 'morph')->where('name', '=', 'sppd');
    }

    public function arsip_sppd()
    {
        return $this->morphOne(File::class, 'morph')->where('name', '=', 'arsip_sppd');
    }

    public function getfilepegawai($spt,$pegawai){
        return $this->where('spt_id',$spt)->where('pegawai_id',$pegawai)->first();;
    }
}
