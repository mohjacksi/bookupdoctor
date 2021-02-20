<table>
    @foreach($days as $day)
        <tr>
            <td>
                <input {{ $day->morning || $day->evening ? 'checked' : null }} data-id="{{ $day->id }}" type="checkbox" class="day-enable">
            </td>
            <td> {{$day->name}} </td>
            <td> صباحاً </td>
            <td>
                <input data-id="{{ $day->id }}"
                    value = "{{ $day->morning ?? null }}"
                    name="days-morning[{{$day->id}}]"
                    type="text"
                    class="day-morning"
                    placeholder="من - الى"
                    {{ $day->morning ? null : 'disabled' }}>
            </td>
            <td> مساءاً </td>
            <td>
                <input data-id="{{ $day->id }}"
                value = "{{ $day->evening ?? null }}"
                    name="days-evening[{{$day->id}}]"
                    type="text"
                    class="day-evening"
                    placeholder="من الى"
                    {{ $day->evening ? null : 'disabled' }}>

            </td>
        </tr>

    @endforeach
</table>


@section('scripts')
    @parent
    <script>
    $('document').ready(function () {
        $('.day-enable').on('click', function() {
            let id = $(this).attr('data-id')
            let enabled = $(this).is(":checked")
            enabled = !enabled
            $('.day-morning[data-id="' + id + '"]').attr('disabled', enabled)
            $('.day-morning[data-id="' + id + '"]').val(null)
            $('.day-evening[data-id="' + id + '"]').attr('disabled', enabled)
            $('.day-evening[data-id="' + id + '"]').val(null)

        })
    });
    </script>
@endsection
