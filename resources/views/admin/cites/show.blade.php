@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cite.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cites.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cite.fields.id') }}
                        </th>
                        <td>
                            {{ $cite->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cite.fields.name') }}
                        </th>
                        <td>
                            {{ $cite->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cites.index') }}">
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
            <a class="nav-link" href="#city_pharmacies" role="tab" data-toggle="tab">
                {{ trans('cruds.pharmacy.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#city_doctors" role="tab" data-toggle="tab">
                {{ trans('cruds.doctor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="city_pharmacies">
            @includeIf('admin.cites.relationships.cityPharmacies', ['pharmacies' => $cite->cityPharmacies])
        </div>
        <div class="tab-pane" role="tabpanel" id="city_doctors">
            @includeIf('admin.cites.relationships.cityDoctors', ['doctors' => $cite->cityDoctors])
        </div>
    </div>
</div>

@endsection