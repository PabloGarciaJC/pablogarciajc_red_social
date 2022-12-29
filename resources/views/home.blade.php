@extends('layouts.app')

@section('dynamic-content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">

                {{-- Publicacion --}}
                @include('includes.listPublication')

                {{-- Contactos --}}
                @include('includes.contacts')

            </div>
        </section>
    </main>
@endsection
