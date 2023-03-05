<?php

namespace App\model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $casts=[
        'id'=>'string',
    ];
    protected $fillable=[
        'id', 'nama', 'nip', 'pangkat', 'golongan','jabatan_id','status','bidang_id'
    ];

    public function jabatan()
    {
        return $this->belongsTo('App\Model\Jabatan');
    }

    public function bidang()
    {
        return $this->belongsTo('App\Model\bidang');
    }

    public function spt()
    {
        return $this->hasMany('App\Model\Spt');
    }

    public function spt_pegawai()
    {
        return $this->hasMany('App\Model\SptPegawai');
    }
}
