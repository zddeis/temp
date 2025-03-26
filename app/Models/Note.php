<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\returnArgument;

class Note extends Model {
    use HasFactory;
    protected $table = "notes";

    protected $fillable = ["title", "body"];

    public function user(){
        return $this->belongsTo(User::class);
    }
}