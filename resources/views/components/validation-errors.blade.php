@php
    $validaciones = $validaciones ?? null;
    $claseFila = $claseFila ?? 'form-group row';
    $claseColumnas = $claseColumnas ?? 'col-12';
    $claseOcultarDiv = $claseOcultarDiv ?? 'd-none';
    $titulo = $titulo ?? 'Por favor, verifica los siguientes campos:';
@endphp

<div class="{{ $claseFila }} div-validacion {{ $claseOcultarDiv }}">
    <div class="{{ $claseColumnas }}">
        <div class="alert alert-danger d-flex align-items-start p-3 mb-3">
            <i class="fas fa-exclamation-circle text-danger me-2"></i>
            <div class="flex-grow-1">
                <span class="fw-semibold">{{ $titulo }}</span>
                <ul class="mensaje-validacion mb-0 mt-2 ps-3 {{ $clases ?? '' }}">
                    @if($validaciones)
                        @foreach($validaciones as $validacion)
                            <li class="text-danger">{{ $validacion }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
