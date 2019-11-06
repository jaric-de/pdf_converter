<?php

declare(strict_types = 1);

namespace App\Services\Converter;

use App\Services\Converter\Processors\ProcessorInterface;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

/**
 * Class Converter
 */
class Converter
{
    public const EXTENSION_PDF = 'pdf';

    public const STORAGE_DISK_ORIGINAL = 'public_original';
    public const STORAGE_DISK_CONVERTED = 'public_converted';

    /**
     * @var string
     */
    private $processor;

    /**
     * @param string $extension
     *
     * @return ProcessorInterface
     */
    public function getProcessor(string $extension): ProcessorInterface
    {
        $this->setProcessorFullyQualifiedName($extension);

        return new $this->processor();
    }

    /**
     * @param $extension
     *
     * @throws InternalErrorException
     *
     * @return void
     */
    private function setProcessorFullyQualifiedName($extension): void
    {
        $processorType = in_array($extension, config('converter.allowed_extensions.image'))
            ? ProcessorInterface::TYPE_IMAGE
            : ucfirst($extension);

        $this->processor = __NAMESPACE__ .
            '\Processors\\' .
            $processorType .
            'Processor';
    }
}
