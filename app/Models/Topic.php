<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 * 
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class Topic extends Model
{
	protected $table = 'topics';

	protected $casts = [
		'category_id' => 'int'
	];

	protected $fillable = [
		'name',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}
}
