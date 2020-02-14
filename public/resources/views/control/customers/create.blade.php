@extends('layouts.app')

@section('content')
@include( '.layouts._left_sidebar')
    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form>
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="now-ui-icons media-2_sound-wave"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Stats</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="now-ui-icons location_world"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="now-ui-icons users_single-02"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Account</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        @include('.menu.menu')

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-content container-fluid card p-3">
                        @if(isset($dataTypeContent->id))
                            <h2>Добавить</h2>
                        @else
                            <h2>Создать</h2>
                         @endif


                            <div class="col-md-8 offset-2">
                                <form class="form-edit-add" role="form"
                                      action="{{route('customers.store')}}"
                                      method="POST" enctype="multipart/form-data" autocomplete="off">
                                    <!-- PUT Method if we are editing -->
                                    @if(isset($dataTypeContent->id))
                                        {{ method_field("PUT") }}
                                    @endif
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="panel panel-bordered">
                                                {{-- <div class="panel"> --}}
                                                @if (count($errors) > 0)
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <div class="panel-body">
                                                    <div class="form-group" >
                                                        <label for="name">Фамилия</label>
                                                        <input type="text" class="form-control" id="name" name="fname" placeholder="Фамилия"
                                                               value="{{ old('fname', $dataTypeContent->fname ?? '') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Имя</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Имя"
                                                               value="{{ old('name', $dataTypeContent->name ?? '') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Отчество</label>
                                                        <input type="text" class="form-control" id="name" name="sname" placeholder="Отчество"
                                                               value="{{ old('sname', $dataTypeContent->sname ?? '') }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">{{ __('voyager::generic.email') }}</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                                               value="{{ old('email', $dataTypeContent->email ?? '') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Телефон</label>
                                                        <the-mask
                                                            class="form-control" value="{{ old('phone', $dataTypeContent->phone ?? '') }}" type="tel" name="phone" required id="phone"    placeholder="Телефон" data-mask="+389999999999" data-reload-payment-form="true"
                                                            mask="+### (##) ###-##-##" />

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">{{ __('voyager::generic.password') }}</label>
                                                        @if(isset($dataTypeContent->password))
                                                            <br>
                                                            <small>{{ __('voyager::profile.password_hint') }}</small>
                                                        @endif
                                                        <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                                                    </div>

                                                    @can('editRoles', $dataTypeContent)
                                                        <div class="form-group">
                                                            <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                                                            @php
                                                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};

                                                                $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                                                $options = $row->details;
                                                            @endphp
                                                            @include('voyager::formfields.relationship')
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="additional_roles">{{ __('voyager::profile.roles_additional') }}</label>
                                                            @php
                                                                $row     = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                                                                $options = $row->details;
                                                            @endphp
                                                            @include('voyager::formfields.relationship')
                                                        </div>
                                                    @endcan
                                                    @php
                                                        if (isset($dataTypeContent->locale)) {
                                                            $selected_locale = $dataTypeContent->locale;
                                                        } else {
                                                            $selected_locale = config('app.locale', 'en');
                                                        }

                                                    @endphp
                                                    <div v-show="false" class="form-group">
                                                        <label for="locale">{{ __('voyager::generic.locale') }}</label>
                                                        <select class="form-control select2" id="locale" name="locale">
                                                            @foreach (Voyager::getLocales() as $locale)
                                                                <option value="{{ $locale }}"
                                                                    {{ ($locale == $selected_locale ? 'selected' : '') }}>{{ $locale }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4" v-show="false">
                                                        <div class="panel panel panel-bordered panel-warning">
                                                            <div class="panel-body">
                                                                <div class="form-group">
                                                                    @if(isset($dataTypeContent->avatar))
                                                                        <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                                                    @endif
                                                                    <input type="file" data-name="avatar" name="avatar">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary pull-right save">
                                                    Сохранить
                                                </button>

                                                </div>
                                            </div>
                                        </div>


                                </form>
                            </div>

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>

                    </div>
                </div>

            </div>
        </div>

@include('.layouts._footer')


    </div>
@endsection
