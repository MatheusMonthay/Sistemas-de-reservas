<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ambiente_id', 'inicio', 'fim', 'ocorrencia'];

    protected $casts = [
        'inicio' => 'datetime',
        'fim' => 'datetime',
    ];

    public function equipamentos()
    {
        return $this->belongsToMany(Equipamento::class, 'reserva_equipamentos');
    }

    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class);
    }

}