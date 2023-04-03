<?php

namespace App\model;

use App\Model\File;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opd extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $casts=[
        'id'=>'string',
    ];
    protected $fillable=[
        'id', 'nama', 'singkatan', 'kode'
    ];

    public function bidang()
    {
        return $this->hasMany('App\Model\Bidang');
    }

    public function nomor_terakhir()
    {
        return $this->hasMany('App\Model\NomorTerakhir');
    }

    public function file()
    {
        return $this->morphOne(File::class, 'morph');
    }
}
