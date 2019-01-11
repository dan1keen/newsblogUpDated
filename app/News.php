<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  protected $fillable = [
  'title',
  'content',
  'author',
  'category',
  'image'
  ];
}
