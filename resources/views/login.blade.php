<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: "Comic Sans MS", cursive;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 400px;
        }

        .card {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease-in-out;
            outline: none;
            color: #333;
        }

        input:focus {
            border-color: #ff4500;
        }

        button {
            background-color: #ff4500;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #e63900;
        }
        #type{
            margin: -2px;
            margin-bottom: 14px;
        }

      
 
    select.btn {
        width: 100%;
        padding: 10px;
        border: 2px solid #007bff;
        border-radius: 5px;
        background-color: white;
        font-size: 16px;
        cursor: pointer;
        outline: none;
        transition: all 0.3s ease-in-out;
    }

  
    select.btn:focus {
        border-color: #0056b3;
        box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
    }


    select.btn::-ms-expand {
        display: none;
    }

 
    select.btn option {
        padding: 10px;
        background-color: white;
        color: black;
    }


    select.btn option:checked {
        background-color: #007bff;
        color: white;
    }
    </style>
</head>
<body>
    <div class="container">
    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div style="color: red; margin-bottom: 10px;">{{ session('error') }}</div>
    @endif
        <div class="card">
            <h2>Login<h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="text" id="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                @error('email')
                    <div style="color: red; font-size:13px">{{ $message }}</div>
                @enderror

                <input type="password" id="password" name="password" placeholder="Password" required>
                @error('password')
                    <div style="color: red; font-size:13px">{{ $message }}</div>
                @enderror

                <select id="type" name="type" class="btn" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="doctor" {{ old('type') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="patient" {{ old('type') == 'patient' ? 'selected' : '' }}>Patient</option>
                </select>
                @error('type')
                    <div style="color: red; font-size:13px">{{ $message }}</div>
                @enderror

                <button type="submit">Login</button>
            </form>


        </div>
    </div>
</body>
</html>