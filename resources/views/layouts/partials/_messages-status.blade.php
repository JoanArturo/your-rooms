@if ($errors->any())
    <div class="alert alert-danger my-4">
        <ul class="m-0 p-0">
            @foreach ($errors->all() as $error)
                <li class="ml-2">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (session()->has('success'))
    <div class="alert alert-success my-4">
        <p class="m-0">{{ session('success') }}</p>
    </div>
@endif