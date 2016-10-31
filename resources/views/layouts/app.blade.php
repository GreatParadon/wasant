<!DOCTYPE html>

<html>
@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="hold-transition @if(Auth::User()) skin-blue sidebar-mini @else login-page @endif ">

@if (Auth::User())

    <div class="wrapper">

    @include('layouts.partials.mainheader')

    @include('layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

        @include('layouts.partials.contentheader')

        <!-- Main content -->
            <section class="content">
                <div>
                    @include('admin.message')
                </div>

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"
                                              aria-expanded="true">{{ $page['title'] or '' }}</a></li>
                        @if(isset($gallery) and $gallery == true and isset($form_data))
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Gallery</a></li>
                        @endif
                        <li class="pull-right">
                            @if(isset($sort) and $sort == true)
                                <a href="{{ $page['content'].'/sort' }}"
                                   class="btn btn-box-tool">Sort {{ $page['content'] }}</a>
                            @endif
                        </li>
                        <li class="pull-right">
                            @if(isset($create) and $create == true)
                                <a href="{{ $page['content'].'/create' }}" class="btn btn-box-tool">Create
                                    new {{ $page['content'] }}</a>
                            @endif
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active table-responsive" id="tab_1">
                            @yield('content')
                        </div>
                        @if(isset($gallery) and $gallery == true and isset($form_data))
                            <div class="tab-pane" id="tab_2">
                                @include('admin.gallery')
                            </div>
                        @endif
                    </div>
                    <!-- /.tab-content -->
                </div>

            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        {{--@include('layouts.partials.footer')--}}

        @include('layouts.partials.controlsidebar')


    </div>
    <!-- ./wrapper -->
@else
    @yield('content')
@endif

@section('scripts')
    @include('layouts.partials.scripts')
@show

</body>
</html>