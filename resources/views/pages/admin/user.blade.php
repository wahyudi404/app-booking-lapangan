@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            {{ __('Data Pengguna') }}
                        </div>
                        <div>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="datatable" class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username & Email</th>
                                    <th>Role</th>
                                    <th>Tanggal Pembuatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td> {{ ++$key }} </td>
                                        <td> {{ $user->fullname }} </td>
                                        <td> {{ $user->username }} | {{ $user->email }}</td>
                                        <td> {{ $user->role->role_name }}</td>
                                        <td> {{ $user->created_at }} </td>
                                        <td>
                                            <button type="button" data-id="{{ $user->id }}"
                                                data-fullname="{{ $user->fullname }}" data-username="{{ $user->username }}"
                                                data-role="{{ $user->role_id }}" data-email="{{ $user->email }}" class="btn btn-edit btn-warning"
                                                data-bs-toggle="modal" data-bs-target="#userModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-id="{{ $user->id }}"
                                                class="btn btn-delete btn-danger" data-bs-toggle="modal" data-bs-target="#delUserModal">
                                                <i class="fa fa-trash"></i>
                                            </button>
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUserModalLabel">Tambah Pengguna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                id="fullname" name="fullname">
                            @error('fullname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">Username
                            <label for="role_id" class="form-label">Role</label>
                            <select name="role_id" id="role_id"
                                class="form-control @error('role_id') is-invalid @enderror">
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password-confirm"
                                name="password_confirmation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userModalLabel">Edit Pengguna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                id="fullname" name="fullname">
                            @error('fullname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" readonly>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select name="role_id" id="role_id"
                                class="form-control @error('role_id') is-invalid @enderror">
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            <span class="text-danger text-sm">* Kosongkan jika tidak ingin mengganti password</span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Delete --}}
    <div class="modal fade" id="delUserModal" tabindex="-1" aria-labelledby="delUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delUserModalLabel">Hapus Pengguna</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <p>Apakah anda yakin ingin menghapus user ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        new DataTable('#datatable');

        const btnActions = $('.btn-action');
        btnActions.click(function() {
            const id = $(this).data('id');
            const action = $(this).data('action');

            $('#id').val(id)
            $('#status').val(action)
            $('#form-update-user').submit()
        })

        const btnEdit = $('.btn-edit');
        btnEdit.click(function() {
            const id = $(this).data('id');
            const fullname = $(this).data('fullname');
            const email = $(this).data('email');
            const username = $(this).data('username');
            const role = $(this).data('role');
            const url = "{{ route('user.update', ':id') }}".replace(':id', id);
            $('#userModal form').attr('action', url)
            $('#userModal').find('#id').val(id)
            $('#userModal').find('#fullname').val(fullname)
            $('#userModal').find('#email').val(email)
            $('#userModal').find('#username').val(username)
            $('#userModal').find('#role_id').val(role).change()
        })

        const btnDelete = $('.btn-delete');
        btnDelete.click(function() {
            const id = $(this).data('id');
            const url = "{{ route('user.destroy', ':id') }}".replace(':id', id);
            $('#delUserModal form').attr('action', url)
            $('#delUserModal').find('#id').val(id)
        })
    </script>
@endsection
