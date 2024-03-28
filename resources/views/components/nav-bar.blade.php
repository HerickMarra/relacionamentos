<link rel="stylesheet" href="{{ asset("components/navbar/navbar.css?v=$version") }}">


{{-- <div class="x-NavBar-Add">
    <div class="x-NavBar-Add-act">
        <i class="bi bi-plus-circle-dotted"></i>
    </div>
    
</div> --}}

<div class="x-NavBar">
    @foreach ($buttons as $btn)
        <div class="x-NavBar-B"><i class="{{$btn['icon']}}"></i></div>
    @endforeach
</div>