<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 *
 */
class Home extends Controller
{
    /**
     * @return Object|null
     */
    public static function lastFolders(): ?Object
    {
        return view('begin', [
            'folders' => \App\Folder::select('*')->limit(5)->orderByDesc('created_at')->get()
        ]);
    }
}
