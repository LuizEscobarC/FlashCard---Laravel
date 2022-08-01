<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 *
 */
class Folder extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'title', 'description'];

    /**
     * @return mixed
     */
    public function user()
    {
        return Users::find($this->getAttributes()['user_id']);
    }

    /**
     * @return int
     */
    public function countCards(): int
    {
        return Card::where('folder_id', $this->getAttributes()['id'])->count();
    }

    /**
     * @param int $folderId
     * @return mixed|null
     */
    public function pager(int $folderId)
    {

        $paginator = Card::where('folder_id', $folderId)->paginate(1);
        // Para pegar o id exato do cartão
        return ($paginator->items() ? $paginator->items()[0] : null);
    }

    /**
     * @param UploadedFile|null $requestFile
     * @return string|null
     */
    public static function saveFolder(?UploadedFile $requestFile): ?string
    {
        if (!empty($requestFile) && $requestFile->isValid() && $requestFile->isFile()) {
            return $requestFile->isValid() ? $requestFile->store('cards') : null;
        }
        return null;
    }

    /**
     * @param string $stringData
     * @return bool
     */
    public static function updateFolder(string $stringData): bool
    {
        parse_str($stringData, $data);
        $folder = Folder::find($data['folder_id']);
        $folder->title = $data['title'];
        $folder->description = $data['description'];
        if ($folder->save()) {
            return true;
        }
        return false;
    }
}
