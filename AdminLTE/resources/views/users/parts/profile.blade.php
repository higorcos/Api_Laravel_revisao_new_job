<div class="card">
    <form action="{{route('users.updateProfile', $user->id)}}" method="POST">
    @csrf
    @method('PUT')

        <div class="card-header">
            Perfil
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Tipo de Pessoa</label>
                <select name="type" id="type"
                    class="form-control @error('type') is-invalid @enderror">                
                   @foreach (['PJ','PF'] as $item)
                       <option value="{{$item}}" 
                       @selected(old('type') === $item || $user?->profile?->type === $item)>
                       
                       {{$item}}
                        </option>
                   @endforeach
                   
                </select>
                @error('type')
                        <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="name" class="form-label">Endereço</label>
                <input 
                    type="text" 
                    name="address" 
                    value="{{old('address') ?? $user?->profile?->address}}"
                    class="form-control @error('address') is-invalid @enderror" >
                    @error('address')
                        <div class="invalid-feedback">{{$message }}</div>
                    @enderror
            </div>

        </div>
        <div class="card-footer">
             <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>