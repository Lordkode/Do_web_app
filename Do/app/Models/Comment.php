<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'note',
        'title',
        'description',
        'topic_id',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
