<x-guest-layout>
    <div class="pt-8 bg-gray-100 min-h-screen">
        <div class="flex flex-col items-center pt-6 sm:pt-0">
            <div class="flex flex-col items-center justify-center gap-6">
                <x-authentication-card-logo />
                <p class="text-xl font-semibold text-blue-800/75 dark:text-dark-blue-600/75">Centro de Dia</p>
            </div>

            <div class="relative mt-10 sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 selection:bg-blue-500 selection:text-white">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">{{ __('Dashboard') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Entrar</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Registar</a>
                            @endif
                        @endauth
                    </div>
                @endif

                <div class="max-w-5xl mx-6 md:mx-0">
                    <div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            <a href="https://www.facebook.com/profile.php?id=100083591925171&sk=about" class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Sobre</h2>
                                    <div class="mb-6">
                                        <h3 class="text-gray-600 font-semibold flex items-center">Morada</h3>
                                        <p class="text-gray-400 flex items-cente">
                                            Rua da Bandeira, 639, Viana do Castelo, Portugal, 4900-561
                                        </p>
                                    </div>
                                    <div class="mb-6">
                                        <h3 class="text-gray-600 font-semibold flex items-center">Telefone</h3>
                                        <p class="text-gray-400 flex items-center">
                                            258 823 029
                                        </p>
                                    </div>
                                    <div class="mb-6">
                                        <h3 class="text-gray-600 font-semibold flex items-center">Endereço</h3>
                                        <p class="text-gray-400 flex items-center">
                                            centrosocial@paroquiafatima.pt
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a href="https://www.google.com/maps/search/Apartado+505+%2F+Rua+da+Bandeira,+639,+Viana+do+Castelo,+Portugal,+4900-561/@41.6981479,-8.8292365,14.14z?entry=ttu"
                                class=" scale-100 rounded-lg flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                                <img src="{{ asset('assets/images/img.png') }}"
                                     alt="Localização do Centro de Dia (Google Maps)"
                                     class="scale-100 via-transparent rounded-lg shadow-2xl shadow-gray-500/20">
                            </a>


                            <a href="https://www.facebook.com/paroquia.nsrafatima.5/"
                               class="scale-100 p-6 bg-white from-gray-700/50 flex justify-between via-transparent rounded-lg shadow-2xl shadow-gray-500/20 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                                <div class="flex gap-6 c">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                                    </svg>

                                    <h2 class="text-xl font-semibold text-gray-900">Redes Sociais</h2>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-blue-500 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </div>
                            </a>

                            <a href="https://www.google.com/search?q=centro+social+e+paroquial+de+n.+s.+de+f%C3%A1tima+viana+do+castelo&rlz=1C1ONGR_pt-PTPT1060PT1060&oq=&gs_lcrp=EgZjaHJvbWUqBggDEEUYOzIGCAAQRRg7MgYIARBFGDsyBggCEEUYOzIGCAMQRRg7MgYIBBBFGEAyBggFEEUYPDIGCAYQRRg9MgYIBxBFGD3SAQg0MDk1ajBqN6gCALACAA&sourceid=chrome&ie=UTF-8#lrd=0xd25b7ce9fab0919:0xc704e0be40e3ac90,1,,,,"
                                   class="scale-100 p-6 bg-white from-gray-700/50 flex justify-between via-transparent rounded-lg shadow-2xl shadow-gray-500/20 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                                <div class="flex gap-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="yellow" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                    </svg>

                                    <h2 class="text-xl font-semibold text-gray-900">Avaliação 4,7/5</h2>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-blue-500 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </div>
                            </a>

                        </div>
                    </div>

                    <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                        <div class="text-center text-sm text-gray-500 sm:text-left">
                            <div class="flex items-center gap-4">
                                <a href="https://github.com/sponsors/taylorotwell" class="group inline-flex items-center hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                    </svg>
                                    Projeto de Aptidão Profissional
                                </a>
                            </div>
                        </div>

                        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                            construído em Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
