<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $table = 'questions';
	public function categories(){
		return $this->hasMany(Category::class,'question_id');
	}
}
