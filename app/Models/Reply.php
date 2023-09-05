<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reply
 * 
 * @property int $id
 * @property int $post_id
 * @property int $score
 * @property string $context
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Post $post
 *
 * @package App\Models
 */
class Reply extends Model
{
	protected $table = 'reply';

	protected $casts = [
		'post_id' => 'int',
		'score' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'post_id',
		'score',
		'context',
		'user_id'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
