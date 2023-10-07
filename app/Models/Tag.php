<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class Tag extends Model
{
	protected $table = 'tags';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function posts()
	{
		return $this->belongsToMany(Post::class, 'tag_post')
					->withPivot('id');
	}
}
