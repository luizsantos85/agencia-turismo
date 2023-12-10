<div class="content-din">
    <div class="messages">
        @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
        @endif
    </div>

    @if (isset($errors) && $errors->any())
    <ul class="list-group">
        @foreach ($errors->all() as $error)
        <li class="list-group-item list-group-item-danger text-white">{{$error}}</li>
        @endforeach
    </ul>
    @endif
</div>