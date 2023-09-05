<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Topic[] $topics
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'category';

	protected $fillable = [
		'name'
	];

	public function topics()
	{
		return $this->hasMany(Topic::class);
	}
}
