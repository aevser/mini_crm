@extends('admin.layouts.app')

@section('content')

    <div class="container-scroller">

        @include('admin.components.sidebar.sidebar')

        <div class="container-fluid page-body-wrapper">

            @include('admin.components.navbar.nav')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Пользователи</h4>

                                    <div style="display: flex; gap: 10px; padding-bottom: 16px;">
                                        <form action="{{ route('admin.admin.create') }}" method="GET">
                                            <button type="submit" class="btn btn-dark btn-rounded btn-fw w-100">+ Администратор</button>
                                        </form>
                                        <form action="{{ route('admin.user.create') }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-dark btn-rounded btn-fw w-100">+ Пользователь</button>
                                        </form>
                                    </div>

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-dark">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Имя</th>
                                                <th>Email</th>
                                                <th>Администратор</th>
                                                <th>Действия</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->hasRole('admin') ? 'Да' : 'Нет' }}</td>
                                                    <td>

                                                        @if($user->hasRole('admin'))
                                                            <form style="display: inline-block;" action="{{ route('admin.admin.edit', $user->id) }}" method="GET">
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="mdi mdi-grease-pencil"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form style="display: inline-block;" action="{{ route('admin.user.edit', $user->id) }}" method="GET">
                                                                <button type="submit" class="btn btn-link p-0">
                                                                    <i class="mdi mdi-grease-pencil"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <form action="{{ route('admin.admin.delete', $user->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link p-0">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="ms-3">
                                                    Показано {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} из {{ $users->total() }} записей
                                                </div>
                                                <div class="d-flex justify-content-center me-3">
                                                    {{ $users->links('admin.components.pagination.pagination') }} <!-- Пагинация -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
