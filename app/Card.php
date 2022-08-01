<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 *
 */
class Card extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'folder_id', 'front', 'back', 'img'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setPerPage(1);
        //
    }
// INICIO DELETE FOLDER BUTTON ACTION

    /**
     * @param string|null $filePath
     * @return void
     */
    public static function unlinkFile( ?string $filePath)
    {
        if (!empty($filePath)) {
            Storage::delete($filePath);
        }
    }
}
