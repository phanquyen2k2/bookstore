<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <style>
        .header {
            margin-bottom: 0; /* Giảm khoảng cách phía dưới của header */
            padding-bottom: 0; /* Giảm khoảng cách phía dưới của header */
        }
        .py-12 {
            padding-top: 1rem; /* Điều chỉnh khoảng cách phía trên */
            padding-bottom: 1rem; /* Điều chỉnh khoảng cách phía dưới */
        }
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header" class="header">
            <x-navadmin/>
            @yield('content')
            
        </x-slot>
    </x-app-layout>
</body>
</html>
