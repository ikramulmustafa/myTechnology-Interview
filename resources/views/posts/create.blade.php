@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">{{ __('Create Posts') }}
                <div class="pull-right">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">
                        User List</a>

                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                        <div class="col-md-6">
                            <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>

                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('featured_image') ? ' has-error' : '' }}">
                        <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Image Upload') }}</label>
                        <div class="col-md-6">

                            <img src="{{asset('images/upload.png')}}"
                                 alt="HTML5 Icon"
                                 style="width:128px;height:128px; display: block;margin: 10px 0;"
                                 id="featured_image">
                            <input type="file" name="featured_image" id="featured_image" class="filestyle"
                                   onchange="readProfileURL(this);" required>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        function readProfileURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#featured_image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endpush
