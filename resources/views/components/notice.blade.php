{{-- @if (Session::has('danger') || Session::has('info') || Session::has('warning') || Session::has('success'))
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Alerts
                    </h3>
                </div>
                <div class="card-body"> --}}
@if (Session::has('danger'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Ошибка!</h5>
        {{ Session::get('danger') }}
    </div>
@endif
@if (Session::has('info'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Информация</h5>
        {{ Session::get('info') }}
    </div>
@endif
@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Внимание!</h5>
        {{ Session::get('warning') }}
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Успех!</h5>
        {{ Session::get('success') }}
    </div>
@endif
{{-- </div>
            </div>
        </div>
    </div>
@endif --}}
