@extends('layouts.app')

@section('content')

    <?php if(0){ ?>

    @include('.layouts._left_sidebar')

    <?php  } ?>


    <div class="main-panel  main-panel-customer" id="main-panel">
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
                    <a class="navbar-brand" href="/">Народний продукт</a>
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
                            <a class="nav-link" href="#pablo" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="now-ui-icons users_single-02"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Account</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                                <a class="dropdown-item" href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Выход
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}"
                                      method="POST"style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


        @include('menu.menu')


        <div class="content">
            <div class="row">
                <div class="col-md-10">
                    @foreach ($categories as $category)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> {{$category->name}}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">

                                            <thead class=" text-primary">

                                            @foreach($category->getHeadersList() as $headersList)
                                                <th>{{ $headersList['name']}}</th>
                                            @endforeach
                                            <th></th>
                                            </thead>
                                            <tbody>
                                            @foreach ($category->getProductsList() as $productList)
                                                <tr>
                                                    <td>
                                                        {{$productList['product']->name}}
                                                    </td>
                                                    <td>
                                                        {{$productList['atr1']}}
                                                    </td>
                                                    <td>
                                                        {{$productList['atr2']}}
                                                    </td>
                                                    <td class="">
                                                        {{$productList['atr3']}}
                                                    </td>
                                                    <td class="">
                                                        {{$productList['atr4']}}
                                                    </td>
                                                    <td class="">
                                                        {{$productList['product']->price}}
                                                    </td>

                                                    <td class="">
                                                        <button-add
                                                         :id="{{$productList['product']->id}}"
                                                         :base_count="0"
                                                         :product="{{ json_encode($productList['product']) }}"
                                                         :price="{{$productList['product']->price}}"
                                                        ></button-add>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-2" style="padding: 0;">

                    <cart
                        {{--                                        :trailerlist="{{json_encode($trailerList)}}"--}}
                    ></cart>

                </div>

            </div>
        </div>

        <footer class="footer">
            <div class=" container-fluid ">
                <nav>
                    <ul>
                        <li>
                            <a href="https://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://presentation.creative-tim.com">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright" id="copyright">
                    &copy;
                </div>
            </div>
        </footer>
    </div>
    @yield('content')


@endsection
