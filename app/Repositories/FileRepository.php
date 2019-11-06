<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Models\File as FileModel;
use Illuminate\Http\UploadedFile;
use const true;
use function pathinfo;

/**
 * Class FileRepository
 *
 * @package App\Repositories
 */
class FileRepository implements FileRepositoryInterface
{
    /**
     * @param UploadedFile $file
     *
     * @return FileModel
     */
    public function store(UploadedFile $file): FileModel
    {
        return FileModel::create([
            'original_name'      => pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME),
            'original_extension' => $file->getClientOriginalExtension(),
            'hashed_name'        => pathinfo($file->hashName(), PATHINFO_FILENAME),
        ])->fresh();
    }

    /**
     * @param FileModel $fileModel
     *
     * @return void
     */
    public function setConvertedStatus(FileModel $fileModel): void
    {
        $fileModel->update([
            'is_converted' => true,
        ]);
    }
}
