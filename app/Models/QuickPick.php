<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuickPick
 * 
 * @property int $id
 * @property int $competition_id
 * @property int $event_id
 * @property int $competitor_id
 * @property float $start_value
 * @property float $end_value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Competition $competition
 * @property Event $event
 *
 * @package App\Models
 */
class QuickPick extends Model
{
	protected $table = 'quick_pick';

	protected $casts = [
		'competition_id' => 'int',
		'event_id' => 'int',
		'competitor_id' => 'int',
		'start_value' => 'float',
		'end_value' => 'float'
	];

	protected $fillable = [
		'competition_id',
		'event_id',
		'competitor_id',
		'start_value',
		'end_value'
	];

	public function competition()
	{
		return $this->belongsTo(Competition::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
