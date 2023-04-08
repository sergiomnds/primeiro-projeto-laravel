<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6">
    <div class="row">
        <div class="col">
            {{-- @include('contacts._company-selection') ;; @includeIf pode ser usado, se tiver ele vai aparecer, e se não, não vai ter mensagem de erro --}}
            @includeWhen(!empty($companies), 'contacts._company-selection') {{--vai incluir a View caso companies não esteja vazio, também evita a mensagem de erro.--}}
            {{--@includeUnless(empty($companies), 'contacts._company-selection'), pode ser usado com a condição contrária de includeWhen e tem o mesmo resultado.--}} 
        </div>
        <div class="col">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fa fa-refresh"></i>
                </button>
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                <i class="fa fa-search"></i>
            </button>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>