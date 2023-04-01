<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'slug',
        'type_koding'
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
}
