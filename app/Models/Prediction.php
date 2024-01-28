<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Prediction
 * 
 * @property int $id
 * @property int $entry_id
 * @property int $event_id
 * @property int $selection_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Entry $entry
 * @property Event $event
 *
 * @package App\Models
 */
class Prediction extends Model
{
	protected $table = 'prediction';

	protected $casts = [
		'entry_id' => 'int',
		'event_id' => 'int',
		'selection_id' => 'int'
	];

	protected $fillable = [
		'entry_id',
		'event_id',
		'selection_id'
	];

	public function entry()
	{
		return $this->belongsTo(Entry::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
