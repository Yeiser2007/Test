@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bienvenido al Dashboard</h1>
    <p>Aquí va el contenido principal.</p>
    <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
</div>
@endsection
