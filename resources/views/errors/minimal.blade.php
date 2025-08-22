<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $exception->getStatusCode() }} | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center max-w-lg mx-auto">
        <h1 class="text-9xl font-extrabold text-red-600">
            {{ $exception->getStatusCode() }}
        </h1>
        <h2 class="text-3xl font-bold mt-4">
            {{ $exception->getMessage() ?: 'Что-то пошло не так' }}
        </h2>

        <p class="text-gray-600 mt-2">
            Попробуйте вернуться назад или перейти на главную.
        </p>

        <div class="mt-6">
            <a href="{{ route('home') }}"
               class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 ml-2">
                🏠 На главную
            </a>
        </div>
    </div>
</body>
</html>
