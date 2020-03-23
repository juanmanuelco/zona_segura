@if (count($errors)>0)
    <div class="centrado  mensaje-error-sistema animated flash">
        <h4 class="calibri" style="color:red">
            @foreach ($errors->all() as $error)
            {{ $error }},
            @endforeach
        </h4>
    </div>
    @endif
@if (session('status'))
    <div class="centrado  mensaje-bien-sistema animated flash">
        <h4 class="calibri" style=" color: #068194">{{ session('status') }}</h4>
    </div>
@endif

@if (session('error'))
<div class="centrado  mensaje-error-sistema animated flash">
        <h4 class="calibri" style="color:red">{{ session('error') }}</h4>
    </div>
@endif