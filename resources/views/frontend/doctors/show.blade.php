@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.doctor.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.doctors.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $doctor->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $doctor->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $doctor->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.about') }}
                                    </th>
                                    <td>
                                        {{ $doctor->about }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.location') }}
                                    </th>
                                    <td>
                                        {{ $doctor->location }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.specialties') }}
                                    </th>
                                    <td>
                                        @foreach($doctor->specialties as $key => $specialties)
                                            <span class="label label-info">{{ $specialties->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.image') }}
                                    </th>
                                    <td>
                                        @if($doctor->image)
                                            <a href="{{ $doctor->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $doctor->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.days') }}
                                    </th>
                                    <td>
                                        @foreach($doctor->days as $key => $days)
                                            <span class="label label-info">{{ $days->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.stars') }}
                                    </th>
                                    <td>
                                        {{ $doctor->stars }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.is_special') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $doctor->is_special ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.is_active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $doctor->is_active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.expiration_date') }}
                                    </th>
                                    <td>
                                        {{ $doctor->expiration_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.latitude') }}
                                    </th>
                                    <td>
                                        {{ $doctor->latitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.longitude') }}
                                    </th>
                                    <td>
                                        {{ $doctor->longitude }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $doctor->city->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.doctors.index') }}">
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