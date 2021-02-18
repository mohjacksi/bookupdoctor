@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.portfolio.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.portfolios.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.portfolio.fields.id') }}
                        </th>
                        <td>
                            {{ $portfolio->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.portfolio.fields.doctor') }}
                        </th>
                        <td>
                            {{ $portfolio->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.portfolio.fields.title') }}
                        </th>
                        <td>
                            {{ $portfolio->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.portfolio.fields.desecration') }}
                        </th>
                        <td>
                            {{ $portfolio->desecration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.portfolio.fields.images') }}
                        </th>
                        <td>
                            @foreach($portfolio->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.portfolios.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection