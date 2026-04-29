<button
    type="submit"
    class="w-full p-2 rounded text-white {{ $getColor() }} 
    
    {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"

    {{ $disabled ? 'disabled' : '' }}>
    
    {{ $slot }}
</button>