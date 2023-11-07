<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;
    protected $table = 'vendas';
    protected $fillable = [
        'valor_venda',
        'data_venda',
        'id_vendedor',
    ];
}
