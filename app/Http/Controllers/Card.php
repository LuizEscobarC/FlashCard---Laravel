<?php

namespace App\Http\Controllers;

use App\Folder;
use App\TraitCallback;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;

/**
 *
 */
class Card extends Controller
{

    use TraitCallback;

    /**
     * GET | responsável por renderizar a view de cartão
     * @param int $folderId
     * @return View
     */
    public static function studyCards(int $folderId): View
    {
        return view('cards', [
            'folder' => Folder::find($folderId),
            'card' => (new \App\Folder())->pager($folderId),
        ]);
    }

    /**
     *
     * GET | responsável por renderizar aview de criaçãod e cartões e pasta
     * @return View
     */
    public static function createGet(): View
    {
        return view('create');
    }

    /**
     * GET | responsável por renderizar a página de edição
     * @param int $idFolder
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function editCardsGet(int $idFolder)
    {
        return view('cards-edit', [
            'cards' => (new \App\Card())->where('folder_id', $idFolder)->get(),
            'folder' => Folder::find($idFolder)
        ]);
    }

    /**
     * POST | responsável por cadastrar uma pasta
     * @param Request $data
     * @return false|string
     */
    public static function createFolderPost(Request $data)
    {
        $data = $data->except('_token');
        $data['user_id'] = 1;
        $result = \App\Folder::create($data);

        if (!empty($result->id)) {
            return self::callback(['folderId'=> $result->id, 'message' => 'Pasta e cartões cadastrados com sucesso!']);
        }

        return self::callback(['message' => 'Não foi possível cadastrar!']);
    }

    /**
     * POST | responsável por cadastrar multiplos cartões e arquivos ou não
     * @param Request $request
     * @return false|string
     */
    public static function createCardsPost(Request $request)
    {
        $forms = $request->except(['_token']);
        for ($i = 2; $i <= count($forms); $i++) {
            if (empty($forms[$i])) {
                continue;
            }
            // PARSEANDO OS DADOS QUE DEVEM SER PARSEADOS
            parse_str($forms[$i], $dataArray);

            $requestArray = new Request($dataArray);
            $dataArray = $requestArray->except(['_token', 'image']);

            /** -test--id- */
            $dataArray['user_id'] = 1;
            /** ---------- */
            // ID DE RETORNO
            $hrefId = $dataArray['folder_id'];

            // SALVA O ARQUIVO SE HOUVER
            $dataArray['img'] = Folder::saveFolder(((!empty($forms[$i * 1000]) ? $forms[$i * 1000] : null)));
            \App\Card::create($dataArray);
        }

        return self::callback(['message' => 'Pasta e cartões cadastrados com sucesso!', 'href' => route('card.edit-get', $hrefId)]);
    }

    /**
     * POST | responsável por editar um ou mais cartões e arquivos
     * @param Request $request
     * @return false|string
     */
    public static function editCardsPost(Request $request)
    {

        // ID DE RETORNO
        parse_str($request->folder, $folder);
        $hrefId = $folder['folder_id'];

        $forms = $request->except(['_token', 'folder']);

        // ATUALIZA A FOLDER
        Folder::updateFolder($request->folder);

        for ($i = 2; $i <= count($forms); $i++) {
            if (empty($forms[$i])) {
                continue;
            }
            // PARSEANDO OS DADOS QUE DEVEM SER PARSEADOS
            parse_str($forms[$i], $dataArray);

            $card = \App\Card::find($dataArray['card_id']);
            $card->front = $dataArray['front'];
            $card->back = $dataArray['back'];

            $requestArray = new Request($dataArray);
            $dataArray = $requestArray->except(['_token', 'image', 'card_id']);

            /** -test--id- */
            $dataArray['user_id'] = 1;
            /** ---------- */
            // SALVA O ARQUIVO SE HOUVER
            if (!empty($forms[$i * 1000])) {
                $cardImgPath = Card::updateImg((!empty($forms[$i * 1000]) ? $forms[$i * 1000] : null), $card->img);
                $card->img = $cardImgPath;
            }
            $card->save();
        }

        return self::callback(['message' => 'Pasta e cartões atualizados com sucesso!', 'href' => route('card.edit-get', $hrefId)]);
    }

    /**
     * POST | responsável por atualizar um arquivo de imagem
     * @param UploadedFile|null $requestFile
     * @param string|null $name
     * @return string|null
     */
    public static function updateImg(?UploadedFile $requestFile, ?string $name): ?string
    {
        if (!empty($name)) {
            $name = explode('cards/', $name)[1];
        }
        if (!empty($requestFile) && $requestFile->isValid()) {
            return $requestFile->isValid() ? (!empty($name) ? $requestFile->storeAs('cards',
                $name) : $requestFile->store('cards')) : null;
        }
        return null;
    }
}
