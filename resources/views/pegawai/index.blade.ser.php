@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Pegawai</h1>
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Pegawai</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th> <!-- New column for 'alamat' -->
                <th>Jenis Kelamin</th> <!-- New column for 'jenis kelamin' -->
                <th>Status</th> <!-- New column for 'status' -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawai as $pgw)
                <tr>
                    <td>{{ $pgw->id }}</td>
                    <td>{{ $pgw->nama }}</td>
                    <td>{{ $pgw->jabatan }}</td>
                    <td>{{ $pgw->alamat }}</td> <!-- Display 'alamat' field -->
                    <td>{{ $pgw->jenis_kelamin }}</td> <!-- Display 'jenis kelamin' field -->
                    <td>{{ $pgw->status }}</td> <!-- Display 'status' field -->
                    <td>
                        <a href="{{ route('pegawai.show', $pgw->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('pegawai.edit', $pgw->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pegawai.destroy', $pgw->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection