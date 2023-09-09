<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div>
            {{ $slot }}
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                    type: 'GET',
                    url: '{{route('departments')}}',
                    dataType:"json",
                    success: function(data) {
                        console.log(data);
                        data.forEach(function (department) {
                            const departmentSelect = document.getElementById("department");
                            const option = document.createElement("option");
                            option.value = department.id;
                            option.text = department.name;
                            departmentSelect.appendChild(option);
                        });
                    }
                });

            department.addEventListener('change', () => {
                let departmentId = department.value;
                if (departmentId > 0) {
                    city.innerHTML = "Elige una ciudad";
                    $.ajax({
                        type: 'GET',
                        url: '{{route('cities', ':departmentId')}}'.replace(':departmentId', departmentId),
                        dataType:"json",
                        success: function(data) {
                            data.forEach(function (city) {
                                const citySelect = document.getElementById("city");
                                const option = document.createElement("option");
                                option.value = city.id;
                                option.text = city.name;
                                citySelect.appendChild(option);
                            });
                        }
                    });
                } else {
                    city.innerHTML = "Elige una ciudad";
                    const citySelect = document.getElementById("city");
                    const option = document.createElement("option");
                    option.value = 0;
                    option.text = "Selecciona una ciudad";
                    citySelect.appendChild(option);
                }
            });
        });
    </script>
</html>
