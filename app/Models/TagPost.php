<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TagPost
 * 
 * @property int $id
 * @property int $post_id
 * @property int $tag_id
 * 
 * @property Post $post
 * @property Tag $tag
 *
 * @package App\Models
 */
class TagPost extends Model
{
	protected $table = 'tag_post';
	public $timestamps = false;

	protected $casts = [
		'post_id' => 'int',
		'tag_id' => 'int'
	];

	protected $fillable = [
		'post_id',
		'tag_id'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
