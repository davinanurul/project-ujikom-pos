<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('asset') }}/dist/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style dasar untuk halaman */
        body {
            background-color: #1f2d3d;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Kotak login */
        .login-box {
            width: 400px;
            height: 400px;
            background-color: #2c3e50;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }

        .login-box h2 {
            color: white;
            margin-bottom: 20px;
        }

        /* Input group */
        .input-group {
            width: 100%;
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .input-group svg {
            flex-shrink: 0;
            margin-right: 10px;
        }

        .input-group input {
            flex-grow: 1;
            background: none;
            border: none;
            outline: none;
            color: black;
            font-size: 16px;
            padding: 5px;
        }
        
        .login-box form {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Tombol Login */
        .login-box button {
            margin-top: 20px;
            background-color: #1fb192;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .login-box button:hover {
            background-color: #13a384;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#2c3e50">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                    <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                </svg>
                <input type="text" name="user_nama" placeholder="Username" required>
            </div>
            <div class="input-group">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#2c3e50">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 2a5 5 0 0 1 5 5v3a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3v-3a5 5 0 0 1 5 -5m0 12a2 2 0 0 0 -1.995 1.85l-.005 .15a2 2 0 1 0 2 -2m0 -10a3 3 0 0 0 -3 3v3h6v-3a3 3 0 0 0 -3 -3" />
                </svg>
                <input type="password" name="user_pass" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
