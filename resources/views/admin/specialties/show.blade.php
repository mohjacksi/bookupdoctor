@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.specialty.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.specialties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.specialty.fields.id') }}
                        </th>
                        <td>
                            {{ $specialty->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialty.fields.name') }}
                        </th>
                        <td>
                            {{ $specialty->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.specialty.fields.icon') }}
                        </th>
                        <td>
                            @if($specialty->icon)
                                <a href="{{ $specialty->icon->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $specialty->icon->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.specialties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#specialties_doctors" role="tab" data-toggle="tab">
                {{ trans('cruds.doctor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="specialties_doctors">
            @includeIf('admin.specialties.relationships.specialtiesDoctors', ['doctors' => $specialty->specialtiesDoctors])
        </div>
    </div>
</div>

@endsection