<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScoringScheme
 * 
 * @property int $id
 * @property string $name
 * @property int $first_place_points
 * @property int $second_place_points
 * @property int $third_place_points
 * @property int $fourth_place_points
 * @property int $fifth_place_points
 * @property int $sixth_place_points
 * @property int $seventh_place_points
 * @property int $eight_place_points
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EventType[] $event_types
 *
 * @package App\Models
 */
class ScoringScheme extends Model
{
	protected $table = 'scoring_scheme';

	protected $casts = [
		'first_place_points' => 'int',
		'second_place_points' => 'int',
		'third_place_points' => 'int',
		'fourth_place_points' => 'int',
		'fifth_place_points' => 'int',
		'sixth_place_points' => 'int',
		'seventh_place_points' => 'int',
		'eight_place_points' => 'int'
	];

	protected $fillable = [
		'name',
		'first_place_points',
		'second_place_points',
		'third_place_points',
		'fourth_place_points',
		'fifth_place_points',
		'sixth_place_points',
		'seventh_place_points',
		'eight_place_points'
	];

	public function event_types()
	{
		return $this->hasMany(EventType::class);
	}
}
