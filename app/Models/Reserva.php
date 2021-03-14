<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'mesa_id',
        'data_reserva',
        'pagamento',
    ];

    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function mesa()
    {
        return $this->belongsTo('App\Models\Mesa');
    }
}
