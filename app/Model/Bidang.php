<?php

namespace App\model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidang extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $casts=[
        'id'=>'string',
    ];
    protected $fillable=[
        'id', 'nama', 'singkatan', 'status','opd_id'
    ];

    public function opd()
    {
        return $this->belongsTo('App\Model\Opd');
    }

    public function kegiatan()
    {
        return $this->hasMany('App\Model\Kegiatan');
    }

    public function pegawai()
    {
        return $this->hasMany('App\Model\Pegawai');
    }

    public function spt()
    {
        return $this->hasMany('App\Model\Spt');
    }

}
