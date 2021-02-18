@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.day.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.days.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.day.fields.id') }}
                        </th>
                        <td>
                            {{ $day->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.day.fields.name') }}
                        </th>
                        <td>
                            {{ $day->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.days.index') }}">
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
            <a class="nav-link" href="#days_doctors" role="tab" data-toggle="tab">
                {{ trans('cruds.doctor.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#days_pharmacies" role="tab" data-toggle="tab">
                {{ trans('cruds.pharmacy.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="days_doctors">
            @includeIf('admin.days.relationships.daysDoctors', ['doctors' => $day->daysDoctors])
        </div>
        <div class="tab-pane" role="tabpanel" id="days_pharmacies">
            @includeIf('admin.days.relationships.daysPharmacies', ['pharmacies' => $day->daysPharmacies])
        </div>
    </div>
</div>

@endsection