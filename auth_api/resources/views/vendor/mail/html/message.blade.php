@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <h3 class="text-center m-0" style="text-align: center;">
                <a href="{{route('home')}}" class="logo logo-admin"><img src="{{asset('assets/images/logo_drresponde.png')}}" style="max-width: 5vw;" alt="logo"></a>
            </h3>
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('Todos direitos reservados.')
        @endcomponent
    @endslot
@endcomponent
