<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Repositories\FileStorageRepositoryInterface;
use App\Models\File as FileModel;
use App\Http\Requests\File\StoreRequest;
use App\Repositories\FileRepositoryInterface;
use App\Services\Converter\Converter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App;
use View;
use function redirect, route;

/**
 * Class FileController
 *
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    public const FILES_PER_PAGE = 10;

    /**
     * @var FileRepositoryInterface
     */
    protected $fileRepository;

    /**
     * @var FileStorageRepositoryInterface
     */
    protected $storageRepository;

    public function __construct(FileRepositoryInterface $fileRepository, FileStorageRepositoryInterface $storageRepository)
    {
        $this->fileRepository = $fileRepository;
        $this->storageRepository = $storageRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): ViewContract
    {
        $files = FileModel::query()
            ->orderBy('created_at', 'desc')
            ->paginate(static::FILES_PER_PAGE);

        return View::make('files.index')->with('files', $files);
    }


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): ViewContract
    {
        return View::make('files.create');
    }

    /**
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $fileModel = $this->fileRepository->store($file);

                $this->storageRepository->setStorage(Converter::STORAGE_DISK_ORIGINAL);
                $this->storageRepository->put($fileModel, $file);

                if ($request->has('convert')) {
                    $this->makeConversion($fileModel);
                }
            }

            return redirect(route('uploaded.files'))
                ->with('success_msg', Lang::trans('file.store.messages.file_uploaded'));
        }
    }

    /**
     * @param FileModel $file
     *
     * @param string $extension
     *
     * @return StreamedResponse
     */
    public function download(FileModel $file, string $extension): StreamedResponse
    {
        $storageType = $extension === Converter::EXTENSION_PDF
            ? Converter::STORAGE_DISK_CONVERTED
            : Converter::STORAGE_DISK_ORIGINAL;

        $this->storageRepository->setStorage($storageType);

        return $this->storageRepository->download($file, $extension);
    }

    /**
     * @param FileModel $file
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function convert(FileModel $file): RedirectResponse
    {
        $this->makeConversion($file);

        return back()->with('success_msg', Lang::trans('file.convert.messages.success_conversion'));
    }

    /**
     * @param FileModel $fileModel
     *
     * @return void
     */
    private function makeConversion(FileModel $fileModel): void
    {
        $converter = App::make(Converter::class);

        $converter
            ->getProcessor($fileModel->getAttribute('original_extension'))
            ->convert($fileModel);

        $this->fileRepository->setConvertedStatus($fileModel);
    }
}
