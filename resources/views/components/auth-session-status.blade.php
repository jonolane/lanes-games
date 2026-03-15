@props(['status'])
@if ($status)
  <div class="mb-4 rounded-sm border border-[#e3e3e0] px-3 py-2 text-sm">
    {{ $status }}
  </div>
@endif
