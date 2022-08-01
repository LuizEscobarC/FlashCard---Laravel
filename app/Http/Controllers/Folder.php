<?php

namespace App\Http\Controllers;

use App\TraitCallback;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\EventListener\ValidateRequestListener;

/**
 *
 */
class Folder extends Controller
{
    use TraitCallback;

    /**
     * @param Request|null $filter
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allFolders(?Request $filter)
    {
        $filter = ($filter->filter ?: null);

        return view('begin', [
            'folders' => \App\Folder::select('*')
                ->where('title', 'like', "%{$filter}%")
                ->orWhere( 'description', 'like', "%{$filter}%")
                ->orderByDesc('created_at')
                ->get()
        ]);
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function deleteFolder(Request $request)
    {
        // DELETA OS ARQUIVOS
        foreach (\App\Card::select('img')->where('folder_id', $request->folder_id)->get() as $img) {
            \App\Card::unlinkFile($img->img);
        }

        $delete = \App\Folder::destroy($request->folder_id);

        if ($delete) {
            return self::callback(['message' => 'Pasta deletada com sucesso.',  'href' => route('home.begin')]);
        }
        return self::callback(['message' => 'Não foi possível deletar a pasta.']);
    }
}
