<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'details';
    
    protected $fillable = [
        'cantidad',
        'descripcion',
        'monto'
    ];

    public function invoice(){
        return $this->belongsTo('App\Models\Invoices');
    }

    protected $dates = ['deleted_at'];
}
