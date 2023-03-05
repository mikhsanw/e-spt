<?php

namespace App\model;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NomorTerakhir extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    protected $casts=[
        'id'=>'string',
    ];
    protected $fillable=[
        'id', 'jenis', 'no_terakhir', 'opd_id'
    ];

    public function opd()
    {
        return $this->belongsTo('App\Model\Opd');
    }
}
