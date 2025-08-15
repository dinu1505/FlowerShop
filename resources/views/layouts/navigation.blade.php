@auth
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        @if(auth()->user()->hasRole('admin'))
            <a href="/admin/flowers" class="text-sm text-gray-700 underline">Manage Flowers</a>
        @endif
        
        @if(auth()->user()->hasRole('supplier'))
            <a href="/supplier/requests" class="text-sm text-gray-700 underline">My Requests</a>
        @endif
        
        <!-- Logout button stays here -->
    </div>
@endauth