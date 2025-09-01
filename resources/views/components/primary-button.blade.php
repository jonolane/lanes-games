@props(['type' => 'submit'])
<button type="{{ $type }}"
  {{ $attributes->merge([
    'class' =>
    'w-full inline-flex items-center justify-center px-5 py-2 rounded-sm
     border border-[#19140035] hover:border-[#1915014a]
     bg-white text-[#1b1b18] transition'
  ]) }}>
  {{ $slot }}
</button>

