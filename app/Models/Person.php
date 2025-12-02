<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model {
    use HasFactory;

    protected $table = 'persons';
    protected $fillable = [
        'name',
        'email',
        'avatar'
    ];

    public function contacts(): HasMany {
        return $this->hasMany(Contact::class);
    }
}
