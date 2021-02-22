@can('pharmacy_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pharmacies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pharmacy.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.pharmacy.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-cityPharmacies">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.is_special') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.is_active') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.expiration_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.phone_number') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pharmacies as $key => $pharmacy)
                        <tr data-entry-id="{{ $pharmacy->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $pharmacy->id ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacy->name ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacy->city->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $pharmacy->is_special ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $pharmacy->is_special ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $pharmacy->is_active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $pharmacy->is_active ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $pharmacy->expiration_date ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacy->phone_number ?? '' }}
                            </td>
                            <td>
                                @can('pharmacy_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pharmacies.show', $pharmacy->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pharmacy_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pharmacies.edit', $pharmacy->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pharmacy_delete')
                                    <form action="{{ route('admin.pharmacies.destroy', $pharmacy->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('pharmacy_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.pharmacies.massDestroy') }}",
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
  let table = $('.datatable-cityPharmacies:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection