@extends('layouts.app')

@section('title')
    {{ trans('file.create.title') }}
@endsection()

@section('content')
    <h2 class="m-3 text-center">{{ trans('file.create.title') }}</h2>
    <div class="row">
        <div class="col-md-12">
            @include('files.partial.form_errors')
        </div>
    </div>
    <div class="row jumbotron">
        <div class="col-md-4 col-md-offset-4">
            <form method="POST" action="{{ route('upload.file') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="attachments">
                        {{ trans('file.create.form.labels.attachments') }}
                    </label>
                    <input type="file" class="form-control-file" id="attachments" name="attachments[]" multiple />
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="convert" name="convert">
                    <label class="form-check-label" for="convert">
                        {{ trans('file.create.form.labels.is_convert') }}
                        <i class="fa fa-file-pdf"></i>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg col-md-6">
                    {{ trans('file.create.form.buttons.send') }}
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <a href="{{ route('uploaded.files') }}"
           class="btn btn-secondary btn-lg col-md-3"
           role="button"
        >
            {{ trans('file.create.buttons.files_list') }}
        </a>
    </div>
@endsection()
