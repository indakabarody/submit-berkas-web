<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Naskah</th>
            <th>Member</th>
            <th>Status</th>
            <th>Dibuat Pada</th>
        </tr>
    </thead>
    <tbody>
    @foreach($scripts as $script)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $script->title }}</td>
            <td>{{ $script->member->name }}</td>
            <td>
                @if (isset($script->reviewed_at) && isset($script->done_reviewed_at))
                    Selesai
                @elseif (isset($script->reviewed_at) && empty($script->done_reviewed_at))
                    Proses
                @else
                    Pending
                @endif
            </td>
            <td>{{ date('d-m-Y', strtotime($script->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
