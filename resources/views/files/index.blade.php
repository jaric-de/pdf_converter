@extends('layouts.app')

@section('title')
    {{ trans('file.index.title') }}
@endsection()

@section('content')
    <h2 class="m-3 text-center">{{ trans('file.index.title') }}</h2>
    <div class="row">

    </div>
    <div class="row">
        @if(Session::has('success_msg'))
            <div class="alert alert-success alert-dismissible col-md-12">
                {{ Session::get('success_msg') }}
                <button type="button" class="close"
                        data-dismiss="alert"
                        aria-label={{ trans('file.alert_panel.close') }}
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('file.index.table.columns.filename') }}</th>
                <th>{{ trans('file.index.table.columns.original_extension') }}</th>
                <th>{{ trans('file.index.table.columns.added_date') }}</th>
                <th>{{ trans('file.index.table.columns.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <td scope="row">{{ $file->getKey() }}</td>
                    <td scope="row">
                        <a href="{{ route('download.file', ['id' => $file->getKey(), 'extension' => $file->getAttribute('original_extension')]) }}">
                            {{ $file->getAttribute('original_name') }}
                        </a>
                    </td>
                    <td scope="row">{{ $file->getAttribute('original_extension') }}</td>
                    <td scope="row">{{ $file->getAttribute('created_at') }}</td>
                    <td>
                        @if($file->getAttribute('is_converted'))
                            <a href="{{ route('download.file', ['id' => $file->getKey(), 'extension' => 'pdf']) }}">
                                {{ trans('file.index.table.links.download_pdf') }}
                            </a>
                        @else
                            <a
                                href="#"
                                onclick="event.preventDefault(); document.getElementById('convert-form-file-{{ $file->getKey() }}').submit();"
                            >
                                {{ trans('file.index.table.links.convert_to_pdf') }}
                            </a>
                            <form
                                id="convert-form-file-{{ $file->getKey() }}"
                                action="{{ route('convert.file', ['id' => $file->getKey()]) }}"
                                method="POST"
                                style="display: none;"
                            >
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-9">
            <a href="{{ route('upload.page') }}" class="btn btn-secondary btn-lg" role="button">{{ trans('file.index.buttons.upload_file') }}</a>
        </div>
        <div class="col-md-3">
            <div class="pagination center">{{ $files->links() }}</div>
        </div>
    </div>
@endsection()
