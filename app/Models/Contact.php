<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'reply',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'read' => 'boolean',
    ];

    /**
     * Get the formatted created date.
     *
     * @return string
     */
    public function getFormattedCreatedAttribute()
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    /**
     * Mark the contact message as read.
     *
     * @return bool
     */
    public function markAsRead()
    {
        return $this->update(['status' => 'read']);
    }

    /**
     * Check if the message is unread.
     *
     * @return bool
     */
    public function isUnread()
    {
        return $this->status === 'unread';
    }

    /**
     * Scope a query to only include unread messages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope a query to only include read messages.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }
}
