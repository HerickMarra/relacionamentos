<link rel="stylesheet" href="{{ asset('components/buttonspainel/buttonspainel.css') }}">

<div class="x-buttonspainel">
    @foreach ($buttons as $btn)
        <div style="color: {{$btn['color']}}" class="x-buttonspainel-btn">
            <i class="{{$btn['icon']}}"></i>
        </div>
    @endforeach
</div>