
@extends('Seller.LayoutSeller');
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <style>
        * {
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        main.table {
            width: 100%;
            height: 100vh;
            box-shadow: 0 0.4rem 0.8rem #0005;
            border-radius: 0.8rem;
            overflow: hidden;
        }

        .table__header {
            width: 100%;
            height: 10%;
            background-color: #fff;
            padding: 0.8rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table__header .input-group {
            width: 35%;
            height: 100%;
            background-color: #f0f0f0;
            padding: 0 0.8rem;
            border-radius: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.2s;
        }

        .table__header .input-group:hover {
            width: 45%;
            background-color: #e0e0e0;
            box-shadow: 0 0.1rem 0.4rem #0002;
        }

        .table__header .input-group img {
            width: 1.2rem;
            height: 1.2rem;
        }

        .table__header .input-group input {
            width: 100%;
            padding: 0 0.5rem 0 0.3rem;
            background-color: transparent;
            border: none;
            outline: none;
        }

        .table__body {
            width: 95%;
            max-height: calc(89% - 1.6rem);
            background-color: #fff;
            margin: 0.8rem auto;
            border-radius: 0.6rem;
            overflow: auto;
        }

        .table__body::-webkit-scrollbar {
            width: 0.5rem;
            height: 0.5rem;
        }

        .table__body::-webkit-scrollbar-thumb {
            border-radius: 0.5rem;
            background-color: #0004;
            visibility: hidden;
        }

        .table__body:hover::-webkit-scrollbar-thumb {
            visibility: visible;
        }

        table {
            width: 100%;
        }

        td img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            vertical-align: middle;
        }

        table, th, td {
            border-collapse: collapse;
            padding: 1rem;
            text-align: left;
        }

        thead th {
            position: sticky;
            top: 0;
            left: 0;
            background-color: #d5d1de;
            cursor: pointer;
            text-transform: capitalize;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr {
            --delay: 0.1s;
            transition: 0.5s ease-in-out var(--delay), background-color 0s;
        }

        tbody tr.hide {
            opacity: 0;
            transform: translateX(100%);
        }

        tbody tr:hover {
            background-color: #f1f1f1 !important;
        }

        tbody tr td,
        tbody tr td p,
        tbody tr td img {
            transition: 0.2s ease-in-out;
        }

        tbody tr.hide td,
        tbody tr.hide td p {
            padding: 0;
            font: 0 / 0 sans-serif;
            transition: 0.2s ease-in-out 0.5s;
        }

        tbody tr.hide td img {
            width: 0;
            height: 0;
            transition: 0.2s ease-in-out 0.5s;
        }
        td {
            text-align: center; /* Căn giữa theo chiều ngang */
            vertical-align: middle; /* Căn giữa theo chiều dọc */
            height: 100px; /* Chiều cao của ô */
        }

        .icon {
            font-size: 25px; /* Tăng kích thước của biểu tượng */
        }
    </style>
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />
    <script>
        const defaultAvatar = '/path/to/default-avatar.jpg'; // Set the path to your default avatar image

        async function deleteUser(userId) {
            try {
                const response = await fetch(`/users/delete/${userId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (response.ok) {
                    const user = await response.json(); // Expect the response to return the user data
                    alertify.success('User deleted successfully');
                    updateRow(user);
                } else {
                    alertify.error('Failed to delete user');
                }
            } catch (error) {
                console.error('Error deleting user:', error);
                alertify.error('An error occurred while deleting the user');
            }
        }

        async function restoreUser(userId) {
            try {
                const response = await fetch(`/users/restore/${userId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (response.ok) {
                    const user = await response.json(); // Expect the response to return the user data
                    alertify.success('User restored successfully');
                    updateRow(user);
                } else {
                    alertify.error('Failed to restore user');
                }
            } catch (error) {
                console.error('Error restoring user:', error);
                alertify.error('An error occurred while restoring the user');
            }
        }

        function updateRow(user) {
            const profilePhotoPath = user.profile_photo_path ? `/storage/${user.profile_photo_path}` : defaultAvatar;
            const $userRow = $(`#user-row-${user.id}`);
            if ($userRow.length) {
                $userRow.html(`
                    <td>${user.id}</td>
                    <td><img src="${profilePhotoPath}" alt="User Photo" width="50" height="50"></td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.email_verified_at}</td>
                    <td>${user.role}</td>
                    <td>${user.deleted_at}</td>
                    <td>
                        <i class="bx bx-archive-in icon" onclick="restoreUser(${user.id})" aria-label="Restore"></i>
                    </td>
                    <td><i class="bx bx-trash icon" onclick="deleteUser(${user.id})" aria-label="Delete"></i></td>
                `);
            }
        }

        $(document).ready(function() {
            // This function will be called once the page is fully loaded
            console.log("Page loaded and ready!");
        });
    </script>
</head>
<body>
    
    
    <main class="table">
        <header class="table__header">
            <h1>User List</h1>
        </header>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Verified At</th>
                        <th>Role</th>
                        <th>Deleted At</th>
                        <th>Update</th>
                        <th>Restore</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr id="user-row-{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ $user->profile_photo_path ? '/storage/' . $user->profile_photo_path : 'data:image/png;base64,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' }}" alt="User Photo" width="50" height="50"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->deleted_at }}</td>
                        <td><a href="/users/edit-users/{{ $user->id}}"><i class='bx bx-message-square-edit icon'></i></td>
                        <td><a href="/users/restore/{{ $user->id}}"><i class='bx bx-archive-in icon'></i></a></td>
                        <td><a href="/users/delete/{{ $user->id}}"><i class='bx bx-trash icon'></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
    
</body>
</html>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

<script>
    $(document).ready(function() {
        @if(session('success'))
        alertify.success("{{ session('success') }}");
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        @if ($errors->any())
            // Hiển thị thông báo lỗi sử dụng Alertify
            alert("{{ $errors->first() }}");
        @endif
    });
</script>
 <!-- JavaScript -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
 <!-- CSS -->
 <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
 <!-- Default theme -->
 <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css" />
 <!-- Semantic UI theme -->
 <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/semantic.min.css" />
 <!-- Bootstrap theme -->
 <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />
 <script>
@endsection