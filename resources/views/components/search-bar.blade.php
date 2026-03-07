{{-- Reusable search bar component --}}
{{-- Usage: @include('components.search-bar', ['target' => 'tableBody', 'placeholder' => 'Cari...']) --}}
@php
$target = $target ?? 'searchableContent';
$placeholder = $placeholder ?? 'Cari data...';
@endphp

<div style="margin-bottom: 1.25rem;">
    <div style="position: relative;">
        <svg style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: #94a3b8; pointer-events: none;"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input type="text" id="searchInput_{{ $target }}" placeholder="{{ $placeholder }}" autocomplete="off"
            style="width: 100%; padding: 10px 40px 10px 42px; border-radius: 12px; border: 1.5px solid #e2e8f0; font-size: 0.875rem; outline: none; transition: all 0.2s; background: #f8fafc; color: #1e293b; box-sizing: border-box;"
            onfocus="this.style.background='#fff'; this.style.borderColor='#6366f1'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
            onblur="this.style.background='#f8fafc'; this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
            oninput="searchFilter_{{ $target }}(this.value)">
        <button type="button" id="clearBtn_{{ $target }}"
            onclick="document.getElementById('searchInput_{{ $target }}').value=''; searchFilter_{{ $target }}(''); this.style.display='none';"
            style="display: none; position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94a3b8; cursor: pointer; padding: 4px;"
            onmouseover="this.style.color='#475569';" onmouseout="this.style.color='#94a3b8';">
            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <p id="searchCount_{{ $target }}"
        style="display: none; font-size: 0.75rem; color: #94a3b8; margin-top: 8px; margin-left: 4px;"></p>
</div>