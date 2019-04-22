
<div class="row alert-msg" style="width:97%">
    @if ($errors->any())
        <div style="width: 100%; text-align: center;">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li class='alert alert-danger' style="direction:ltr">
                        <strong>{{ $error }}</strong>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('sucess'))
        <div style="width: 100%; text-align: center;">
            <ul class="list-unstyled">
                <li class='alert alert-success' style="direction:ltr">
                    <strong>{{ $message }}</strong>
                </li>
            </ul>
        </div>
    @endif
</div>
