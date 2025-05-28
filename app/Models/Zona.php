<?php

namespace App\Models;

use App\Models\Cidade;
use App\Models\Representante;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Zona extends Pivot
{
    protected $table = 'cidade_representante';

    public $incrementing = false;
    public $timestamps = true; 

    protected $fillable = [
        'representante_id',
        'cidade_id',
    ];

    public function representante()
    {
        return $this->belongsTo(Representante::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }
}
