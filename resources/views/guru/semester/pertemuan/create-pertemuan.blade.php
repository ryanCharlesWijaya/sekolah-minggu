@extends('layouts.app')

@section('content')
    <div class="w-100 row ps-8 pe-2 pt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="py-8">Tambah Pertemuan</h2>
                </div>
                <form action="{{ route("guru.semester.pertemuan.store") }}" method="post" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="semester_id" value="{{ request()->input("semester_id") }}">

                    <x-text-input
                        type="text"
                        name="judul"
                        title="Judul Pertemuan"
                        id="judul-input"
                        required="required"
                        />

                    <div class="mb-3">
                      <label for="" class="form-label">Deskripsi</label>
                      <textarea class="form-control" name="deskripsi" id="deskripsi-input" rows="3" required="require"></textarea>
                    </div>

                    <x-text-input
                        type="date"
                        name="tanggal"
                        title="Tanggal Pertemuan"
                        id="tanggal-input"
                        required="required"
                        />

                    <div class="mb-3">
                        <label for="file-input" class="form-label">Materi</label>
                        <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file-input">

                        @error('file')
                            <div class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
