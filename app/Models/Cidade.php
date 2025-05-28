<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cidade extends Model
{
    use HasFactory;

    protected $table = 'cidades';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['estado', 'nome'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'cidade_id', 'id');
    }

    public function representantes()
    {
        return $this->belongsToMany(Representante::class, 'cidade_representante');
    }
}
