<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="role-tab" data-bs-toggle="tab" data-bs-target="#role"
                type="button" role="tab" aria-controls="role" aria-selected="true">
            Dados do Usuário
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="password-security-tab" data-bs-toggle="tab" data-bs-target="#password-security" type="button" role="tab" aria-controls="password-security" aria-selected="false">
            Segurança/Senha
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="permission-tab" data-bs-toggle="tab" data-bs-target="#permission" type="button" role="tab" aria-controls="permission" aria-selected="false">
            Cargo do usuário
        </button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="role" role="tabpanel" aria-labelledby="role-tab">
        <fieldset class="mt-3 mb-3">
            <div class="form-group mb-2">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user?->name ?? old('name') }}">
            </div>
            <div class="form-group mb-2">
                <label for="username">Nome de usuário</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $user?->username ?? old('username') }}">
            </div>
            <div class="form-group mb-2">
                <label for="email">Email/login</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user?->email ?? old('email') }}">
            </div>
        </fieldset>
    </div>
    <div class="tab-pane fade" id="password-security" role="tabpanel" aria-labelledby="password-security-tab">
        <fieldset class="mt-3 mb-3">
            <div class="form-group mb-2">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $user?->username }}" readonly>
            </div>
            <div class="form-group mb-2">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group mb-2">
                <label for="password_confirmation">Confirmação da Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
        </fieldset>
    </div>
    <div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="permission-tab">
        <fieldset class="mt-3 mb-3">
            @foreach ($roles as $role)
                @php
                    $find_role = (array_filter($user?->roles->toArray() ?? [], function ($list_role) use ($role) {
                        if (isset($list_role['name'])) {
                            return ($list_role['name'] === $role->name);
                        }
                    }));
                    $find_role = array_shift($find_role);
                @endphp

                <div class="form-group mb-2">
                    <label for="{{ "role_{$role?->id}" }}">
                        <input type="checkbox" name="roles[]" id="{{ "role_{$role?->id}" }}" value="{{ $role?->id }}" {{ (isset($find_role['name']) && $find_role['name'] == $role?->name) ? 'checked' : '' }}>
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
        </fieldset>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <button class="btn btn-success w-100"><i class="bi bi-save"></i> Gravar</button>
    </div>
</div>
