<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'montant',
        'date',
        'note',
    ];

    public function parent()
    {
        return $this->belongsTo(Parentt::class);
    }
}
