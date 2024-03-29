<link rel="stylesheet" href="{{ asset("components/record/addimage/addimage.css?v=$version") }}">

<div id="x-addimage-images" class="x-addimage-images">

</div>



<div style="display: none;" class="modal x-addimage-form">
    <div class="x-addimage-form-area">
        <div onclick="x_addimage_hideModal()" class="modalExit"><button>X</button></div>
        <div id="imagePreview"></div>
        <label class="x-addimage-label" for="x-addimage-inoput-image"><i class="bi bi-plus-circle-dotted"></i></label>
        <input style="display: none;" type="file" name="x-addimage-inoput-image" id="x-addimage-inoput-image" accept="image/*">

        {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
        <button onclick="x_addimage_adicionar()">Adicionar</button>
    </div>
</div>

<div class="x-addimage">
    <div onclick="x_addimage_showModal()" class="x-addimage-add">
        <i class="bi bi-plus-circle-dotted"></i>
    </div>
</div>


<script>

    let X_addimage_token = '{{csrf_token()}}';
</script>
<script src="{{ asset('components/record/addimage/addimage.js') }}"></script>
