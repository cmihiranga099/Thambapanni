<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'new' => 'bg-blue-100 text-blue-800',
            'read' => 'bg-green-100 text-green-800',
            'replied' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}
