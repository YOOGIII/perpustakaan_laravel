<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .form {
            --input-focus: #2d8cf0;
            --font-color: #323232;
            --font-color-sub: #666;
            --bg-color: #fff;
            --main-color: #323232;
            padding: 20px;
            background: lightgrey;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            gap: 15px;
            border-radius: 5px;
            border: 2px solid var(--main-color);
            box-shadow: 4px 4px var(--main-color);
            width: 300px;
        }

        .title {
            color: var(--font-color);
            font-weight: 900;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .input {
            width: 100%;
            height: 35px;
            border-radius: 5px;
            border: 2px solid var(--main-color);
            background-color: var(--bg-color);
            box-shadow: 4px 4px var(--main-color);
            font-size: 15px;
            font-weight: 600;
            color: var(--font-color);
            padding: 5px 10px;
            outline: none;
        }
        .input1 {
            width: 92%;
            height: 35px;
            border-radius: 5px;
            border: 2px solid var(--main-color);
            background-color: var(--bg-color);
            box-shadow: 4px 4px var(--main-color);
            font-size: 15px;
            font-weight: 600;
            color: var(--font-color);
            padding: 5px 10px;
            outline: none;
        }

        .input::placeholder {
            color: var(--font-color-sub);
            opacity: 0.8;
        }

        .input:focus {
            border: 2px solid var(--input-focus);
        }

        .button-confirm {
            width: 100%;
            height: 40px;
            border-radius: 5px;
            border: 2px solid var(--main-color);
            background-color: var(--bg-color);
            box-shadow: 4px 4px var(--main-color);
            font-size: 17px;
            font-weight: 600;
            color: var(--font-color);
            cursor: pointer;
            margin-top: 20px;
        }

        .button-confirm:active {
            box-shadow: 0px 0px var(--main-color);
            transform: translate(3px, 3px);
        }
    </style>
</head>
<body>
<div class="container">
    <form class="form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="title">Log in.</div>
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="input">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required class="input1">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button type="submit" class="button-confirm">Login</button>
        </div>
    </form>
</div>

<script>
    @if (session('error'))
        alert("Anda tidak memiliki hak akses");
    @endif
</script>
</body>
</html>
