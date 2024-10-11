<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venda extends Model
{
    use HasFactory;
    protected $table = "venda";
    public $timestamps = false;
    protected $casts = [
        'data' => 'datetime:Y-m-d',
    ];    

    public function item_vendas(): HasMany
    {
        return $this->hasMany(Item_venda::class);
    }    

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }    

}
