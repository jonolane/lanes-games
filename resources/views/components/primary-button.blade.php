@props(['type' => 'submit'])
<button type="{{ $type }}"
  {{ $attributes->merge([
    'class' =>
    'w-full inline-flex items-center justify-center px-5 py-2 inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal'
  ]) }}>
  {{ $slot }}
</button>

