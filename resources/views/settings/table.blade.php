<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="settings-table">
        <thead>
        <tr>
            <th>Room</th>
            <th>Start work time</th>
            <th>End work time</th>
            <th>Duration
                <small>Min.</small>
            </th>
            <th>Break Time
                <small>Min.</small>
            </th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($settings as $setting)
            <tr>
                <td>{!! $setting->room_name !!}</td>
                <td>{!! $setting->startWorkTime !!}</td>
                <td>{!! $setting->endWorkTime !!}</td>
                <td>{!! $setting->durationOfRoomReservation !!}</td>
                <td>{!! $setting->breakTimeBetweenEachBooking !!}</td>
                <td>
                    <div class='btn-group'>
                        {{--
                                            <a href="{!! route('settings.show', [$settings->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        --}}
                        <a href="{!! route('settings.edit', [$setting->id]) !!}" class='btn btn-default btn-xs'><i
                                    class="glyphicon glyphicon-edit"></i></a>
                        {{--
                                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        --}}
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>