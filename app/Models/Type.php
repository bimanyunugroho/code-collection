<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'slug',
        'type_koding',
        'colors'
    ];

    /* Buat slug */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function codexes()
    {
        return $this->hasMany(Codex::class, 'type_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function canEdit(User $user)
    {
        return $user->id === $this->user_id;
    }

    public function canDelete(User $user)
    {
        return $user->id === $this->user_id;
    }

}
