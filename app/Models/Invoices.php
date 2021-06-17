<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoices extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'invoices';
    
    protected $fillable = [
        'nro_factura',
        'fecha',
        'nombre',
        'nit',
        'precio',
        'iva',
        'sub_total',
        'total'
    ];

    public function details(){
        return $this->hasMany('App\Models\Detail');
    }

    protected $dates = ['deleted_at'];
}
