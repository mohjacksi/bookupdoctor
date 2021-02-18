@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.payments.update", [$payment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.payment.fields.type') }}</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Payment::TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', $payment->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="doctor_id">{{ trans('cruds.payment.fields.doctor') }}</label>
                            <select class="form-control select2" name="doctor_id" id="doctor_id">
                                @foreach($doctors as $id => $doctor)
                                    <option value="{{ $id }}" {{ (old('doctor_id') ? old('doctor_id') : $payment->doctor->id ?? '') == $id ? 'selected' : '' }}>{{ $doctor }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('doctor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.doctor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pharmacy_id">{{ trans('cruds.payment.fields.pharmacy') }}</label>
                            <select class="form-control select2" name="pharmacy_id" id="pharmacy_id">
                                @foreach($pharmacies as $id => $pharmacy)
                                    <option value="{{ $id }}" {{ (old('pharmacy_id') ? old('pharmacy_id') : $payment->pharmacy->id ?? '') == $id ? 'selected' : '' }}>{{ $pharmacy }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pharmacy'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pharmacy') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.pharmacy_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date">{{ trans('cruds.payment.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date', $payment->date) }}">
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amount">{{ trans('cruds.payment.fields.amount') }}</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" step="0.01" required>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="month_added">{{ trans('cruds.payment.fields.month_added') }}</label>
                            <input class="form-control" type="number" name="month_added" id="month_added" value="{{ old('month_added', $payment->month_added) }}" step="1" required>
                            @if($errors->has('month_added'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('month_added') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.month_added_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{ trans('cruds.payment.fields.notes') }}</label>
                            <textarea class="form-control" name="notes" id="notes">{{ old('notes', $payment->notes) }}</textarea>
                            @if($errors->has('notes'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('notes') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payment.fields.notes_helper') }}</span>
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