<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
  protected $fillable = [
    'title', 'content'
  ];

  public static function valid($id='') {
    return array(
      'title' => 'required|min:3|unique:services,title'.($id ? ",$id" :''),
      'content' => 'required|min:50|unique:services,content'.($id ? ",$id" :'')
    );
  }
}
