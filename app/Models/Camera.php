<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
  use HasFactory;

  protected $table = "cameras";

  protected $fillable = [
    'ip',
    'port',
    'count',
    'source',
    'city',
    'country',
    'code',
    'lat',
    'long' 
  ];


}
