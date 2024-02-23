<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="h-screen">
        <div class=" flex h-full bg-gray-800 " :class="{ 'overflow-hidden': isSideMenuOpen }">
            <!-- Desktop sidebar -->

            <aside class="z-20 flex-shrink-0 hidden w-60 pl-2 overflow-y-auto bg-gray-800 md:block">
                <div>
                    <div class="text-white">
                        <div class="mt-3">
                            <abbr title="Perfil de Usuario">
                                <a href="{{ route('profile.show') }}">
                                    <img class="text-center m-auto hidden mb-2 h-24 w-24 rounded-full sm:block object-cover border-2 border-green-300 hover:border-sky-400"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="">
                                </a>
                            </abbr>
                            <div class="border-y-2 border-emerald-400 py-2">
                                <p class="font-bold text-lg  text-gray-200 text-center uppercase ">
                                    {{ Auth::user()->apellido }}
                                </p>
                                <p class="font-bold text-sm text-gray-400 text-center ">{{ Auth::user()->name }}</p>
                                <p class="font-bold text-sm text-gray-100 text-center ">{{ Auth::user()->cargo }}</p>
                            </div>
                        </div>
                        <div>
                            <ul class="mt-6 leading-10">
                                <p class="ml-2 border-green-500 border-b-2 mb-1 text-sm text-gray-50 opacity-80">
                                    Operaciones
                                    <li class="relative px-1">
                                        <a class="inline-flex items-center w-full text-xs font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                            href="#">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                data-icon="briefcase"
                                                class="h-6 w-6 svg-inline--fa fa-briefcase fa-w-16" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                    d="M320 336c0 8.84-7.16 16-16 16h-96c-8.84 0-16-7.16-16-16v-48H0v144c0 25.6 22.4 48 48 48h416c25.6 0 48-22.4 48-48V288H320v48zm144-208h-80V80c0-25.6-22.4-48-48-48H176c-25.6 0-48 22.4-48 48v48H48c-25.6 0-48 22.4-48 48v80h512v-80c0-25.6-22.4-48-48-48zm-144 0H192V96h128v32z">
                                                </path>
                                            </svg>
                                            <span class="ml-2 text-xs">COMISIONES</span>
                                        </a>
                                    </li>
                                    <li class="relative px-1">
                                        <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                            href="#">
                                            <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="file"
                                                class="h-6 w-6 svg-inline--fa fa-file fa-w-12" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                <path fill="currentColor"
                                                    d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48z">
                                                </path>
                                            </svg>
                                            <span class="ml-2 text-xs">INFORMES</span>
                                        </a>
                                    </li>
                                    {{-- @if (Auth::user()->rol_id == '3')
                                        <li class="relative px-1 ">
                                            <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                                href="{{ route('bandeja.index') }}">
                                                <svg aria-hidden="true" class="h-6 w-6" focusable="false"
                                                    data-prefix="fas" data-icon="tasks"
                                                    class="svg-inline--fa fa-tasks fa-w-16" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path fill="currentColor"
                                                        d="M139.61 35.5a12 12 0 0 0-17 0L58.93 98.81l-22.7-22.12a12 12 0 0 0-17 0L3.53 92.41a12 12 0 0 0 0 17l47.59 47.4a12.78 12.78 0 0 0 17.61 0l15.59-15.62L156.52 69a12.09 12.09 0 0 0 .09-17zm0 159.19a12 12 0 0 0-17 0l-63.68 63.72-22.7-22.1a12 12 0 0 0-17 0L3.53 252a12 12 0 0 0 0 17L51 316.5a12.77 12.77 0 0 0 17.6 0l15.7-15.69 72.2-72.22a12 12 0 0 0 .09-16.9zM64 368c-26.49 0-48.59 21.5-48.59 48S37.53 464 64 464a48 48 0 0 0 0-96zm432 16H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z">
                                                    </path>
                                                </svg>
                                                <span class="ml-2 text-xs">BANDEJA INFORMES</span>
                                            </a>
                                        </li>
                                    @endif --}}

                                <p class="ml-2 border-green-500 border-b-2 mb-1 text-sm text-gray-50 opacity-80">
                                    Actividades
                                    Realizadas
                                </p>

                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tools"
                                            class="svg-inline--fa fa-tools fa-w-16 h-7 w-7" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M501.1 395.7L384 278.6c-23.1-23.1-57.6-27.6-85.4-13.9L192 158.1V96L64 0 0 64l96 128h62.1l106.6 106.6c-13.6 27.8-9.2 62.3 13.9 85.4l117.1 117.1c14.6 14.6 38.2 14.6 52.7 0l52.7-52.7c14.5-14.6 14.5-38.2 0-52.7zM331.7 225c28.3 0 54.9 11 74.9 31l19.4 19.4c15.8-6.9 30.8-16.5 43.8-29.5 37.1-37.1 49.7-89.3 37.9-136.7-2.2-9-13.5-12.1-20.1-5.5l-74.4 74.4-67.9-11.3L334 98.9l74.4-74.4c6.6-6.6 3.4-17.9-5.7-20.2-47.4-11.7-99.6.9-136.6 37.9-28.5 28.5-41.9 66.1-41.2 103.6l82.1 82.1c8.1-1.9 16.5-2.9 24.7-2.9zm-103.9 82l-56.7-56.7L18.7 402.8c-25 25-25 65.5 0 90.5s65.5 25 90.5 0l123.6-123.6c-7.6-19.9-9.9-41.6-5-62.7zM64 472c-13.2 0-24-10.8-24-24 0-13.3 10.7-24 24-24s24 10.7 24 24c0 13.2-10.7 24-24 24z">
                                            </path>
                                        </svg>
                                        <span class="ml-2 text-xs">MANTENIMIENTOS</span>
                                    </a>
                                </li>
                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="radiation" class="svg-inline--fa fa-radiation fa-w-16 h-7 w-7 "
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                            <path fill="currentColor"
                                                d="M328.2 255.8h151.6c9.1 0 16.8-7.7 16.2-16.8-5.1-75.8-44.4-142.2-102.5-184.2-7.4-5.3-17.9-2.9-22.7 4.8L290.4 188c22.6 14.3 37.8 39.2 37.8 67.8zm-37.8 67.7c-12.3 7.7-26.8 12.4-42.4 12.4-15.6 0-30-4.7-42.4-12.4L125.2 452c-4.8 7.7-2.4 18.1 5.6 22.4C165.7 493.2 205.6 504 248 504s82.3-10.8 117.2-29.6c8-4.3 10.4-14.8 5.6-22.4l-80.4-128.5zM248 303.8c26.5 0 48-21.5 48-48s-21.5-48-48-48-48 21.5-48 48 21.5 48 48 48zm-231.8-48h151.6c0-28.6 15.2-53.5 37.8-67.7L125.2 59.7c-4.8-7.7-15.3-10.2-22.7-4.8C44.4 96.9 5.1 163.3 0 239.1c-.6 9 7.1 16.7 16.2 16.7z">
                                            </path>
                                        </svg>
                                        <span class="ml-2 text-xs">MEDICIONES RNI</span>
                                    </a>
                                </li>
                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <x-zondicon-radio class="w-7 h-7" />
                                        <span class="ml-2 text-xs">CONSTATACIONES TV-FM</span>
                                    </a>
                                </li>
                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-2 text-xs">PROMOCIONES</span>
                                    </a>
                                </li>

                                <p class="ml-2 border-green-500 border-b-2 mb-1 text-sm text-gray-50 opacity-80">
                                    Patrimonio
                                </p>
                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <x-codicon-radio-tower class="w-7 h-7" />
                                        <span class="ml-2 text-xs">ESTACIONES</span>
                                    </a>
                                </li>


                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="boxes"
                                            class="h-6 w-6 svg-inline--fa fa-boxes fa-w-18" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                d="M560 288h-80v96l-32-21.3-32 21.3v-96h-80c-8.8 0-16 7.2-16 16v192c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16V304c0-8.8-7.2-16-16-16zm-384-64h224c8.8 0 16-7.2 16-16V16c0-8.8-7.2-16-16-16h-80v96l-32-21.3L256 96V0h-80c-8.8 0-16 7.2-16 16v192c0 8.8 7.2 16 16 16zm64 64h-80v96l-32-21.3L96 384v-96H16c-8.8 0-16 7.2-16 16v192c0 8.8 7.2 16 16 16h224c8.8 0 16-7.2 16-16V304c0-8.8-7.2-16-16-16z">
                                            </path>
                                        </svg>
                                        <span class="ml-2 text-xs">INVENTARIO DE EQUIPOS</span>
                                    </a>
                                </li>
                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M502.6 182.6l-45.25-45.25C451.4 131.4 443.3 128 434.8 128H384V80C384 53.5 362.5 32 336 32h-160C149.5 32 128 53.5 128 80V128H77.25c-8.5 0-16.62 3.375-22.62 9.375L9.375 182.6C3.375 188.6 0 196.8 0 205.3V304h128v-32C128 263.1 135.1 256 144 256h32C184.9 256 192 263.1 192 272v32h128v-32C320 263.1 327.1 256 336 256h32C376.9 256 384 263.1 384 272v32h128V205.3C512 196.8 508.6 188.6 502.6 182.6zM336 128h-160V80h160V128zM384 368c0 8.875-7.125 16-16 16h-32c-8.875 0-16-7.125-16-16v-32H192v32C192 376.9 184.9 384 176 384h-32C135.1 384 128 376.9 128 368v-32H0V448c0 17.62 14.38 32 32 32h448c17.62 0 32-14.38 32-32v-112h-128V368z" />
                                        </svg>
                                        <span class="ml-2 text-xs">TALLER DE COMUNICACIONES</span>
                                    </a>
                                </li>

                                <p class="ml-2 border-green-500 border-b-2 mb-1 text-sm text-gray-50 opacity-80">Otros
                                </p>
                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                            class="h-6 w-6 svg-inline--fa fa-eye fa-w-18">
                                            <path fill="currentColor"
                                                d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z" />
                                        </svg>
                                        <span class="ml-2 text-xs">REQUERIMIENTOS</span>
                                    </a>
                                </li>
                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href="#">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="eye"
                                            class="h-6 w-6 svg-inline--fa fa-eye fa-w-18" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                            </path>
                                        </svg>
                                        <span class="ml-2 text-xs">OBSERVACIONES</span>
                                    </a>
                                </li>

                                <li class="relative px-1 ">
                                    <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-green-500"
                                        href=" #">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                            data-icon="exclamation-triangle"
                                            class="h-6 w-6 svg-inline--fa fa-exclamation-triangle fa-w-18"
                                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                                            </path>
                                        </svg>
                                        <span class="ml-2 text-xs">ALERTAS</span>
                                    </a>
                                </li>

                                <li class="relative px-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-red-500">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                data-icon="sign-out-alt" class="w-6 h-6" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                    d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z">
                                                </path>
                                            </svg>
                                            <span class="ml-2 text-xs">
                                                {{ __('SALIR') }}
                                            </span>
                                        </button>

                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="flex flex-col flex-1 w-full overflow-y-auto">
                <main class="">
                    <div class="grid mb-4 pb-10 mt-3 px-8 mx-4 h-full rounded-3xl bg-gray-100 border-4 border-green-400">
                        <div class="grid grid-cols-12 gap-6">
                            <div class="grid grid-cols-12 col-span-12 gap-6 xxl:col-span-9">
                                <div class="col-span-12 mt-8">
                                    <div class="flex items-center h-10 intro-y">
                                        <h2 class="mr-5 text-lg font-medium truncate">Dashboard</h2>
                                    </div>
                                    <div class="grid grid-cols-12 gap-6 mt-5">
                                        <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                            href="#">
                                            <div class="p-5">
                                                <div class="flex justify-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-7 w-7 text-blue-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                    </svg>
                                                    <div
                                                        class="bg-green-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                                        <span class="flex items-center">30%</span>
                                                    </div>
                                                </div>
                                                <div class="ml-2 w-full flex-1">
                                                    <div>
                                                        <div class="mt-3 text-3xl font-bold leading-8">4.510
                                                        </div>

                                                        <div class="mt-1 text-base text-gray-600">Item Sales
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                            href="#">
                                            <div class="p-5">
                                                <div class="flex justify-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-7 w-7 text-yellow-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                    </svg>
                                                    <div
                                                        class="bg-red-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                                        <span class="flex items-center">30%</span>
                                                    </div>
                                                </div>
                                                <div class="ml-2 w-full flex-1">
                                                    <div>
                                                        <div class="mt-3 text-3xl font-bold leading-8">4.510
                                                        </div>

                                                        <div class="mt-1 text-base text-gray-600">Item Sales
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                            href="#">
                                            <div class="p-5">
                                                <div class="flex justify-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-7 w-7 text-pink-600" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                                    </svg>
                                                    <div
                                                        class="bg-yellow-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                                        <span class="flex items-center">30%</span>
                                                    </div>
                                                </div>
                                                <div class="ml-2 w-full flex-1">
                                                    <div>
                                                        <div class="mt-3 text-3xl font-bold leading-8">4.510
                                                        </div>

                                                        <div class="mt-1 text-base text-gray-600">Item Sales
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                            href="#">
                                            <div class="p-5">
                                                <div class="flex justify-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-7 w-7 text-green-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                                    </svg>
                                                    <div
                                                        class="bg-blue-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                                        <span class="flex items-center">30%</span>
                                                    </div>
                                                </div>
                                                <div class="ml-2 w-full flex-1">
                                                    <div>
                                                        <div class="mt-3 text-3xl font-bold leading-8">4.510
                                                        </div>

                                                        <div class="mt-1 text-base text-gray-600">Item Sales
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
</x-app-layout>