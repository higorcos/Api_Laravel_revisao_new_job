 <div class="app-content-header">
    <div class="container-fluid">
    <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                @hasSection ('page-title')

                    <h3 class="mb-0">@yield('page-title')</h3>
                    
                @endif
                @isset ($breadcrumbs)
                <ol class="breadcrumb">
                    @foreach ($breadcrumbs as $item)
                        <li class="breadcrumb-item"><a href="{{$item['url']}}">{{$item['label']}}</a></li>
                       {{--  <li class="breadcrumb-item active" aria-current="page">Dashboard</li> --}}
                    @endforeach
                </ol>
                @endisset
            </div>
        
        <div class="col-sm-6 text-end">
            @yield('page-actions')
        </div>
        </div>
    <!--end::Row-->
    </div>
</div>