<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
            <x-navadmin />
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <x-welcome />
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
