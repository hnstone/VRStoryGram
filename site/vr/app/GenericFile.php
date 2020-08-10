<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericFile extends Model
{

    const PREVIEW_FILE_SUFFIX = '_preview';
    const THUMBNAIL_FILE_SUFFIX = '_thumbnail';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'filename', 'uri', 'filemime', 'filesize', 'filename_orig'
    ];

}
