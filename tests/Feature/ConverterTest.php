<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\File as FileModel;
use App\Services\Converter\Converter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use const true;
use function storage_path, md5_file;


/**
 * Class ConverterTest
 *
 * @package Tests\Feature
 */
class ConverterTest extends TestCase
{
    public const ORIGINAL_FILE_NAME = 'test';
    public const ORIGINAL_FILE_EXT = 'html';

    /**
     * @var FileModel
     */
    private $fileModel;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHtmlConversion(): void
    {
        $this->createFileModel(storage_path('app/test/test.html'));

        $this->app->make(Converter::class)
            ->getProcessor($this->fileModel->getAttribute('original_extension'))
            ->convert($this->fileModel);

        $this->assertTrue(
            File::exists(
                storage_path('app/public/converted/') .
                $this->fileModel->getKey() .
                '/' .
                $this->fileModel->getAttribute('hashed_name') .
                '.' .
                Converter::EXTENSION_PDF
            )
        );

        // Removing original and converted files
        File::deleteDirectory(storage_path('app/public/converted/') .
            $this->fileModel->getKey());
        File::deleteDirectory(storage_path('app/public/original/') .
            $this->fileModel->getKey());
    }

    /**
     * Set file model.
     *
     * @param string $filePath
     *
     * @return void
     */
    private function createFileModel(string $filePath): void
    {
        $this->fileModel = FileModel::query()->create([
            'original_name'      => static::ORIGINAL_FILE_NAME,
            'original_extension' => static::ORIGINAL_FILE_EXT,
            'hashed_name'        => md5_file($filePath),
            'is_converted'       => true,
        ])->fresh();


        if (file_exists($filePath)) {
            Storage::disk(Converter::STORAGE_DISK_ORIGINAL)->put(
                $this->fileModel->getKey() .
                '/' .
                $this->fileModel->getAttribute('hashed_name') .
                '.' .
                $this->fileModel->getAttribute('original_extension'),
                File::get($filePath)
            );
        }
    }
}
