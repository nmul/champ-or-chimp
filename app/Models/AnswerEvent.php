<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnswerEvent
 * used for moving answers from frontend
 * 
 * @property int $answerId
 * @property string $eventId
 * @property string $fieldName
 * @package App\Models
 */


class AnswerEvent extends Model
{
    use HasFactory;
    protected $fillable = ['answerId', 'eventId', 'fieldName'];
}
