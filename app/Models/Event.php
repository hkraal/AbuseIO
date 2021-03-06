<?php namespace AbuseIO\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Event
 * @package AbuseIO\Models
 * @property integer $ticket_id
 * @property integer $evidence_id
 * @property string $source
 * @property integer $timestamp
 * @property string $information
 */
class Event extends Model
{
    use SoftDeletes;

    protected $table    = 'events';

    protected $fillable = [
        'ticket_id',
        'evidence_id',
        'source',
        'timestamp',
        'information'
    ];

    protected $guarded  = [
        'id'
    ];

    /**
     * Validation rules for this model being created
     *
     * @param  \AbuseIO\Models\Event $event
     * @return array $rules
     */
    public static function createRules(/** @noinspection PhpUnusedParameterInspection */ $event)
    {
        $rules = [
            'ticket_id'             => 'required|integer',
            'evidence_id'           => 'required|integer',
            'source'                => 'required|string',
            'timestamp'             => 'required|timestamp',
            'information'           => 'required|json',
        ];

        return $rules;
    }

    /**
     * Validation rules for this model being updated
     *
     * @param  \AbuseIO\Models\Event $event
     * @return array $rules
     */
    public static function updateRules(/** @noinspection PhpUnusedParameterInspection */ $event)
    {
        $rules = [
            'ticket_id'             => 'required|integer',
            'evidence_id'           => 'required|integer',
            'source'                => 'required|string',
            'timestamp'             => 'required|timestamp',
            'information'           => 'required|json',
        ];

        return $rules;
    }

    /**
     * Return the evidence for this event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evidences()
    {

        return $this->hasMany('AbuseIO\Models\Evidence', 'id', 'evidence_id');

    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */
    /**
     * Mutates the seen attribute to a date format
     *
     * @return bool|string
     */
    public function getSeenAttribute()
    {
        return date(config('app.date_format').' '.config('app.time_format'), $this->attributes['timestamp']);
    }
}
