<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setAuthorAttribute($author)
    {
        $this->attributes['author_id'] = Author::firstOrCreate([
            'name' => $author,
        ]);
    }
}
