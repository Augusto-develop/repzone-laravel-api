<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Representante extends Model
{
    use HasFactory;
    
    public $incrementing = false;    
    protected $keyType = 'string';

    protected $fillable = ['nome'];
   
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
    /**
     * Relacionamento N:N com cidades.
     */
    public function cidades(): BelongsToMany
    {        
        return $this->belongsToMany(Cidade::class, 'cidade_representante')
                ->using(Zona::class)
                ->withTimestamps();
    }
}
