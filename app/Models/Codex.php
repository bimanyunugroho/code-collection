<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Codex extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'type_uuid',
        'judul',
        'slug',
        'keterangan'
    ];

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

    public function types()
    {
        return $this->belongsTo(Type::class, 'type_uuid', 'uuid');
    }

}
