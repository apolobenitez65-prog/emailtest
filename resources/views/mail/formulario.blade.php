<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Enviar correo</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-2xl">

            {{-- Encabezado --}}
            <div class="text-center mb-6">

                <h1 class="text-3xl font-bold text-gray-800">
                    Envío de correo
                </h1>

                <p class="text-gray-500 mt-2">
                    Laravel + Brevo SMTP
                </p>

            </div>

            {{-- Mensaje exitoso --}}
            @if (session('success'))

                <div
                    class="
                        mb-5
                        p-4
                        rounded-lg
                        bg-green-100
                        border
                        border-green-300
                        text-green-800
                    "
                >
                    {{ session('success') }}
                </div>

            @endif

            {{-- Mensaje de error --}}
            @if (session('error'))

                <div
                    class="
                        mb-5
                        p-4
                        rounded-lg
                        bg-red-100
                        border
                        border-red-300
                        text-red-800
                    "
                >
                    {{ session('error') }}
                </div>

            @endif

            {{-- Errores de validación --}}
            @if ($errors->any())

                <div
                    class="
                        mb-5
                        p-4
                        rounded-lg
                        bg-red-100
                        border
                        border-red-300
                        text-red-800
                    "
                >
                    <ul class="list-disc pl-5">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>
                </div>

            @endif

            {{-- Formulario --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">

                <form
                    action="{{ route('mail.enviar') }}"
                    method="POST"
                >

                    @csrf

                    {{-- Destinatario --}}
                    <div class="mb-5">

                        <label
                            for="destinatario"
                            class="block mb-2 font-semibold text-gray-700"
                        >
                            Correo destinatario
                        </label>

                        <input
                            type="email"
                            id="destinatario"
                            name="destinatario"
                            value="{{ old('destinatario') }}"
                            placeholder="ejemplo@correo.com"
                            required
                            class="
                                w-full
                                px-4
                                py-3
                                border
                                border-gray-300
                                rounded-lg
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-500
                            "
                        >

                        @error('destinatario')

                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    {{-- Nombre --}}
                    <div class="mb-5">

                        <label
                            for="nombre"
                            class="block mb-2 font-semibold text-gray-700"
                        >
                            Nombre del destinatario
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            placeholder="Juan Pérez"
                            required
                            class="
                                w-full
                                px-4
                                py-3
                                border
                                border-gray-300
                                rounded-lg
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-500
                            "
                        >

                        @error('nombre')

                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    {{-- Asunto --}}
                    <div class="mb-5">

                        <label
                            for="asunto"
                            class="block mb-2 font-semibold text-gray-700"
                        >
                            Asunto
                        </label>

                        <input
                            type="text"
                            id="asunto"
                            name="asunto"
                            value="{{ old('asunto') }}"
                            placeholder="Ingrese el asunto"
                            required
                            class="
                                w-full
                                px-4
                                py-3
                                border
                                border-gray-300
                                rounded-lg
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-500
                            "
                        >

                        @error('asunto')

                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    {{-- Mensaje --}}
                    <div class="mb-6">

                        <label
                            for="mensaje"
                            class="block mb-2 font-semibold text-gray-700"
                        >
                            Mensaje
                        </label>

                        <textarea
                            id="mensaje"
                            name="mensaje"
                            rows="7"
                            placeholder="Escriba aquí el contenido del correo..."
                            required
                            class="
                                w-full
                                px-4
                                py-3
                                border
                                border-gray-300
                                rounded-lg
                                resize-none
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-500
                            "
                        >{{ old('mensaje') }}</textarea>

                        @error('mensaje')

                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                    {{-- Botón --}}
                    <button
                        type="submit"
                        class="
                            w-full
                            bg-blue-600
                            hover:bg-blue-700
                            text-white
                            font-semibold
                            py-3
                            px-6
                            rounded-lg
                            transition
                        "
                    >
                        Enviar correo
                    </button>

                </form>

            </div>

            <p class="text-center text-gray-400 text-sm mt-5">
                Sistema de notificaciones
            </p>

        </div>

    </div>

</body>

</html>