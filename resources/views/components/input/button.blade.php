<div {{ $attributes->merge(['class' => $isSelected('22') ? "selected" : "not"]) }}>
    <div {{ $attributes->class(['pr-4','md-5'])->merge(['class' => 'mm5']) }}>
        <h1>UU</h1>
    </div>
    <button {{ $attributes->merge(['type'=>'button']) }} >
            {{ $slot }}
    </button>
</div>
