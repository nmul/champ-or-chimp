<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Entry
 * 
 * @property int $id
 * @property int $user_id
 * @property int $competition_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $golf_1_id
 * @property int $golf_2_id
 * @property int $golf_3_id
 * @property int $double_points_1_id
 * @property int $double_points_2_id
 * @property int $double_points_3_id
 * @property int $double_points_4_id
 * @property bool $is_quick_pick
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Competition $competition
 * @property Golf $golf
 * @property User $user
 * @property Collection|MissingField[] $missing_fields
 * @property Collection|Prediction[] $predictions
 *
 * @package App\Models
 */
class Entry extends Model
{
	protected $table = 'entry';

	protected $casts = [
		'user_id' => 'int',
		'competition_id' => 'int',
		'golf_1_id' => 'int',
		'golf_2_id' => 'int',
		'golf_3_id' => 'int',
		'double_points_1_id' => 'int',
		'double_points_2_id' => 'int',
		'double_points_3_id' => 'int',
		'double_points_4_id' => 'int',
		'is_quick_pick' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'competition_id',
		'first_name',
		'last_name',
		'email',
		'golf_1_id',
		'golf_2_id',
		'golf_3_id',
		'double_points_1_id',
		'double_points_2_id',
		'double_points_3_id',
		'double_points_4_id',
		'is_quick_pick'
	];

	public function competition()
	{
		return $this->belongsTo(Competition::class);
	}

	public function golf()
	{
		return $this->belongsTo(Golf::class, 'golf_3_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function missing_fields()
	{
		return $this->hasMany(MissingField::class);
	}

	public function predictions()
	{
		return $this->hasMany(Prediction::class);
	}
}
