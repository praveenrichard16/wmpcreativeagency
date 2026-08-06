<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic',
        'message',
        'status',
        'priority',
        'internal_note',
    ];

    /**
     * Relationship: SupportTicket belongs to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: SupportTicket has many messages.
     */
    public function messages()
    {
        return $this->hasMany(SupportTicketMessage::class);
    }
}
