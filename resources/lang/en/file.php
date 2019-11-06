<?php

declare(strict_types = 1);

return [
    'index' => [
        'title' => 'Files List',
        'table' => [
            'columns' => [
                'filename'           => 'Filename',
                'original_extension' => 'Original Extension',
                'added_date'         => 'Added Date',
                'actions'            => 'Actions',
            ],
            'links' => [
                'download_pdf'   => 'Download PDF',
                'convert_to_pdf' => 'Convert to PDF',
            ],
        ],
        'buttons' => [
            'upload_file' => 'Upload file(s)',
        ],
    ],
    'create' => [
        'title' => 'Files Uploader',
        'form'  => [
            'labels' => [
                'attachments' => 'Attachments:',
                'is_convert'  => 'Convert into the PDF',
            ],
            'buttons' => [
                'send' => 'Send',
            ],
        ],
        'buttons' => [
            'files_list' => 'Files list',
        ],
    ],
    'store' => [
        'messages' => [
            'file_uploaded' => 'File(s) uploaded!',
        ],
    ],
    'convert' => [
        'messages' => [
            'success_conversion' => 'Success conversion',
            'unsupported_extension' => 'has unsupported file\'s extension',
        ],
    ],
    'alert_panel' => [
        'close' => 'Close',
    ],
];
