@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('doctor_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.doctors.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.doctor.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.doctor.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Doctor">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.doctor.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctor.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctor.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctor.fields.specialties') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctor.fields.stars') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctor.fields.is_special') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctor.fields.is_active') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.doctor.fields.city') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($specialties as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($cites as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $key => $doctor)
                                    <tr data-entry-id="{{ $doctor->id }}">
                                        <td>
                                            {{ $doctor->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $doctor->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $doctor->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($doctor->specialties as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $doctor->stars ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $doctor->is_special ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $doctor->is_special ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $doctor->is_active ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $doctor->is_active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $doctor->city->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('doctor_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.doctors.show', $doctor->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('doctor_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.doctors.edit', $doctor->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('doctor_delete')
                                                <form action="{{ route('frontend.doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('doctor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.doctors.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Doctor:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection