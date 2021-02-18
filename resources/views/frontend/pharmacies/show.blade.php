@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.pharmacy.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pharmacies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $pharmacy->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $pharmacy->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.logo') }}
                                    </th>
                                    <td>
                                        @if($pharmacy->logo)
                                            <a href="{{ $pharmacy->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $pharmacy->logo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $pharmacy->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $pharmacy->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.days') }}
                                    </th>
                                    <td>
                                        @foreach($pharmacy->days as $key => $days)
                                            <span class="label label-info">{{ $days->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.latitude') }}
                                    </th>
                                    <td>
                                        {{ $pharmacy->latitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.longitude') }}
                                    </th>
                                    <td>
                                        {{ $pharmacy->longitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.is_special') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $pharmacy->is_special ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.is_active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $pharmacy->is_active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.expiration_date') }}
                                    </th>
                                    <td>
                                        {{ $pharmacy->expiration_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pharmacy.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $pharmacy->phone_number }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.pharmacies.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection