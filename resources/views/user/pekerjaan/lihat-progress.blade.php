@extends('user.layouts.app')

@section('content')
<h1>Progress untuk {{ $pekerjaan->nama_pekerjaan }}</h1>

<table>
    <thead>
        <tr>
            <th>Tanggal Waktu</th>
            <th>Kondisi Cuaca</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pekerjaan->progress as $progress)
            <tr>
                <td>{{ $progress->tanggal_waktu_pengerjaan }}</td>
                <td>{{ $progress->kondisi_cuaca }}</td>
                <td>
                    @foreach(json_decode($progress->foto) as $foto)
                        <img src="{{ asset('storage/' . $foto) }}" alt="Progress Foto" width="100">
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
