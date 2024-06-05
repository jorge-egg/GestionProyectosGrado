

@php
    $contador = 0;
    $ponderado = null;
    //dd($subItems[1]);
    //dd($itemId);
    foreach ($itemId as $item) {
        if($item->item_pond == $subItems[1]){
            $ponderado = $item->ponderado;
            $ponderadoSub = $ponderado/count($subItems[0]);
        }
    }
    $valor = '';
    $array = [];
    //dd('kk');
    if(isset($valSelects[2][0])){
        foreach ($valSelects[2] as $key) {
            array_push($array, $key->valor);
        }
        //dd($array.'2');
    }else{
        //dd($subItems);
        for($i = 0 ; $i < count($subItems[0]); $i++) {
            array_push($array, 'no');
        }
    }
    //dd($array);
@endphp



@foreach ($subItems[0] as $subItem)

    <div class="input-group mb-3 campos-calificacion" style="display: flex">
        <p class="form-control auto-expand">

            {{ $subItem->SubItem }}

        </p>

        <span class="input-group-text" id="basic-addon2" style="display: flex">
            <select class="form-select" aria-label="Default select example" name="{{ $subItem->codigo.$jurado }}" {{$idJurado['anteproyecto']->juradoDos == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento || $idJurado['anteproyecto']->juradoUno == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? '' : 'disabled'}}>
                <option value="si" {{$array[$contador] == 'si' ? 'selected' : ''}}>Si</option>
                <option value="parcial" {{$array[$contador] == 'parcial' ? 'selected' : ''}}>Parcial</option>
                <option value="no" {{$array[$contador] == 'no' ? 'selected' : ''}}>No</option>
            </select>
        </span>
    </div>

    @php
        $contador++;
    @endphp
@endforeach



