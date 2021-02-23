@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pharmacy.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pharmacies.update", [$pharmacy->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.pharmacy.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $pharmacy->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="logo">{{ trans('cruds.pharmacy.fields.logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                </div>
                @if($errors->has('logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.logo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location">{{ trans('cruds.pharmacy.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $pharmacy->location) }}" required>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="notes">{{ trans('cruds.pharmacy.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $pharmacy->notes) }}" required>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.pharmacy.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $city)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $pharmacy->city->id ?? '') == $id ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="days">{{ trans('cruds.pharmacy.fields.days') }}</label>
                @include('admin.pharmacies.partials.days')
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.days_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="latitude">{{ trans('cruds.pharmacy.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number" name="latitude" id="latitude" value="{{ old('latitude', $pharmacy->latitude) }}" step="0.00001" required>
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="longitude">{{ trans('cruds.pharmacy.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number" name="longitude" id="longitude" value="{{ old('longitude', $pharmacy->longitude) }}" step="0.00001" required>
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_special') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_special" value="0">
                    <input class="form-check-input" type="checkbox" name="is_special" id="is_special" value="1" {{ $pharmacy->is_special || old('is_special', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_special">{{ trans('cruds.pharmacy.fields.is_special') }}</label>
                </div>
                @if($errors->has('is_special'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_special') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.is_special_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $pharmacy->is_active || old('is_active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.pharmacy.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="expiration_date">{{ trans('cruds.pharmacy.fields.expiration_date') }}</label>
                <input class="form-control date {{ $errors->has('expiration_date') ? 'is-invalid' : '' }}" type="text" name="expiration_date" id="expiration_date" value="{{ old('expiration_date', $pharmacy->expiration_date) }}">
                @if($errors->has('expiration_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expiration_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.expiration_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.pharmacy.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $pharmacy->phone_number) }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pharmacy.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.logoDropzone = {
    url: '{{ route('admin.pharmacies.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="logo"]').remove()
      $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pharmacy) && $pharmacy->logo)
      var file = {!! json_encode($pharmacy->logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
