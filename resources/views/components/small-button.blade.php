<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-3 py-1.5 bg-gray-100 border border-gray-300 rounded font-medium text-xs text-gray-700 shadow-sm hover:bg-gray-200 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200']) }}>
    {{ $slot }}
</button>

