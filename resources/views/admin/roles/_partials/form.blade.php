<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="role-tab" data-bs-toggle="tab" data-bs-target="#role"
                type="button" role="tab" aria-controls="role" aria-selected="true">
            Dados do Cargo
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="permission-tab" data-bs-toggle="tab" data-bs-target="#permission" type="button" role="tab" aria-controls="permission" aria-selected="false">
            Permissões do Cargo
        </button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="role" role="tabpanel" aria-labelledby="role-tab">
        <div class="row mt-4">
            <label class="col-12 mb-3">
                <span>Name: </span>
                <input type="text" name="role[name]" class="form-control" placeholder="Name:" value="{{ $role?->name }}" />
            </label>
            <label class="col-12 mb-3">
                <span>Description: </span>
                <input type="text" name="role[details]" class="form-control"
                       placeholder="Description:" value="{{ $role?->details }}" />
            </label>
            <label class="col-12 mb-3">
                <span>Grupo ativo: </span>
                <input type="hidden" name="role[active]" value="no">
                <input type="checkbox" name="role[active]" id="active" {{ $role?->active == 'yes' ? 'checked' : '' }} value="yes">
            </label>
        </div>
    </div>
    <div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="permission-tab">
        <div class="row mt-4">
            @foreach ($components ?? [] as $component)
                @php
                    $permission = array_filter($permissions ?? [], function ($permission) use ($component) {
                        if (isset($permission['name'])) {
                            return $permission['name'] === $component->name;
                        }
                    });
                    $permission = array_shift($permission);
                @endphp

                    <!--Valores padrões-->
                <input type="hidden" name="permissions[{{ $component->name }}][create]" value="no">
                <input type="hidden" name="permissions[{{ $component->name }}][read]" value="no">
                <input type="hidden" name="permissions[{{ $component->name }}][update]" value="no">
                <input type="hidden" name="permissions[{{ $component->name }}][delete]" value="no">

                <div class="col-12 mb-2">
                    <p class="mb-3">{{ $component->description }}</p>
                    <input type="hidden" name="permissions[{{ $component->name }}][name]" value="{{ $component->name }}">
                    <input type="hidden" name="permissions[{{ $component->name }}][id]" value="{{ $permission['id'] ?? 0 }}">
                    <div class="d-flex flex-row justify-content-between">
                        <label class="col" style="margin-bottom: 10px;">
                            <span>Criar: </span>
                            <input type="checkbox" name="permissions[{{ $component->name }}][create]" id="create" {{ isset($permission['create']) && $permission['create'] == 'yes' ? 'checked' : '' }} value="yes">
                        </label>
                        <label class="col" style="margin-bottom: 10px;">
                            <span>Ler: </span>
                            <input type="checkbox" name="permissions[{{ $component->name }}][read]" id="read" {{ isset($permission['read']) && $permission['read'] == 'yes' ? 'checked' : '' }} value="yes">
                        </label>
                        <label class="col" style="margin-bottom: 10px;">
                            <span>Editar: </span>
                            <input type="checkbox" name="permissions[{{ $component->name }}][update]" id="update" {{ isset($permission['update']) && $permission['update'] == 'yes' ? 'checked' : '' }} value="yes">
                        </label>
                        <label class="col" style="margin-bottom: 10px;">
                            <span>Deletar: </span>
                            <input type="checkbox" name="permissions[{{ $component->name }}][delete]" id="delete" {{ isset($permission['delete']) && $permission['delete'] == 'yes' ? 'checked' : '' }} value="yes">
                        </label>
                    </div>
                    <hr>
                </div>
            @endforeach

        </div>
    </div>
</div>
<div class="col-12 mt-5">
    <button type="submit" class="btn btn-success btn-lg w-100">Salvar</button>
</div>
