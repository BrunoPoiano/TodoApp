<?php

namespace App\Models\Todo;

use Database\Factories\AfazerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afazer extends Model
{
    use HasFactory;
    protected $fillable = ['afazer', 'prioridade'];	
}
