<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
      'title', 'content'
    ];

    public static function valid($id='') {
      return array(
        'title' => 'required|min:3|unique:abouts,title'.($id ? ",$id" :''),
        'content' => 'required|min:50|unique:abouts,content'.($id ? ",$id" :'')
      );
    }
}
