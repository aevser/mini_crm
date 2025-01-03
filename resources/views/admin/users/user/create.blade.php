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
                                    <h4 class="card-title">Создание администратора</h4>

                                    <form class="forms-sample" action="{{ route('admin.user.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Имя</label>
                                            <input name="name" type="text" class="form-control" id="exampleInputUsername1" placeholder="Имя" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Пароль</label>
                                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль" requiredr>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Сохранить</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
