<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekonbiller extends Model
{
    use HasFactory;
    protected $table = 'rekon_biller';
    //*! protected $fillable =['nama','nik','no_kk','jenis_kelamin','alamat'];

    //*! supaya tidak ketik field satu2 ada cara ke -2
    protected $guarded = [];
}
