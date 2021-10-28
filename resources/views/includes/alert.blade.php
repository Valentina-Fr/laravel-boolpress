@if(session('alert-message'))
    <div class="alert alert-{{ session('alert-type') }}">
        {{ session('alert-message') }}
    </div>
@endif