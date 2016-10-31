@if(session('success'))
    <div class="callout alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <i class="icon fa fa-check"></i>{{ session('success') }}
    </div>
@elseif(session('failed'))
    <div class="callout alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <i class="icon fa fa-ban"></i>{{ session('failed') }}
    </div>
@elseif(session('info'))
    <div class="callout alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <i class="icon fa fa-info"></i>{{ session('info') }}
    </div>
@endif