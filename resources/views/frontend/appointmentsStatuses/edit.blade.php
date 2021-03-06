@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.appointmentsStatus.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.appointments-statuses.update", [$appointmentsStatus->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.appointmentsStatus.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $appointmentsStatus->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointmentsStatus.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="color">{{ trans('cruds.appointmentsStatus.fields.color') }}</label>
                            <input class="form-control" type="text" name="color" id="color" value="{{ old('color', $appointmentsStatus->color) }}" required>
                            @if($errors->has('color'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('color') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.appointmentsStatus.fields.color_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection