@props(['data', 'id' => null])

<input
    name="{{ $data['handle'] }}"
    id="{{ $id ?? $data['handle'] }}"
    value="{{ $data['old'] }}"
    placeholder="{{ $data['placeholder'] ?? '' }}"
    x-model="dynamic_form.{{ $data['handle'] }}"
    {{ in_array('required', $data['validate'] ?? []) ? 'required ' : '' }}
    {{ $attributes->merge(['class' => isset($data['validate']) && in_array('required', $data['validate']) ? 'required' : '']) }}
    type="text"
    autocomplete="disabled"
/>
