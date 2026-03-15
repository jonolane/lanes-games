@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}
{!! $attributes->merge([
'class' => '
w-full
rounded-sm
border border-[#3E3E3A]
bg-[#1f1f1f]
text-white
p-2
transition-colors duration-150
hover:bg-[#2a2a2a]
focus:bg-[#2e2e2e]
focus:outline-none
'
]) !!}>
