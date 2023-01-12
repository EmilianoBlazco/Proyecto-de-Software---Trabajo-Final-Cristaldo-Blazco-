<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Profile') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    @vite('resources/css/material-kit.css')

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

{{--                <x-jet-section-border />--}}

            @endif
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
{{--                <div class="mt-10 sm:mt-0">--}}
                    @livewire('profile.update-password-form')
{{--                </div>--}}

                <x-jet-section-border />
                    {{--                Agregar boton centrado con etiqueta buscar sin livewire--}}
                    <div class="text-center">
                        <form action="{{route('datosExtraUsuarios.edit',auth()->user()->id)}}" method="get">
                            <button type="submit" class="btn btn-primary btn-round">
                                <i class="material-icons"></i> Editar datos extras del perfil
                            </button>
                        </form>
                    </div>
                <x-jet-section-border />

            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
{{--                <div class="mt-10 sm:mt-0">--}}
                    @livewire('profile.two-factor-authentication-form')
{{--                </div>--}}

{{--                <x-jet-section-border />--}}
            @endif

{{--            <div class="mt-10 sm:mt-0">--}}
                @livewire('profile.logout-other-browser-sessions-form')
{{--            </div>--}}

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
{{--                <x-jet-section-border />--}}

{{--                <div class="mt-10 sm:mt-0">--}}
                    @livewire('profile.delete-user-form')
{{--                </div>--}}
            @endif
        </div>
    </div>
</x-app-layout>
