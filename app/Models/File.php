<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'files';

    /**
     * @var string[]
     */
    protected $fillable = [
        'file_name',
        'file_data',
        'participant_id',
    ];
}
