@props(['disabled' => false])
<input {{ $disabled ? 'disabled' : '' }}
  {!! $attributes->merge([
    'class' =>
    'mt-1 block w-full rounded-sm border border-[#e3e3e0] bg-white
     px-3 py-2 text-sm text-[#1b1b18]
     focus:outline-none focus:ring-2 focus:ring-[#19140035]'
  ]) !!}>
