<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
          
        }

        .title {
            color: white;
            font-size: 40px;
            /* padding-top: 4%; */
            padding-left: 2%;
            font-weight: bolder;
        }

        .container {
            background-color: #55459d;
            height: 15vh;
            display: flex;
        }

        .logo-pahang {
            height: 70%; 
            padding-top: 2vh;
            padding-left: 2vh;
        }

        .footer {
            background-color: #55459d;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .content {
            display: flex;
            justify-content: center; /* Center inner-content horizontally */
        }

        .inner-content {
            height: 90vh;
            padding: 20px;
            overflow-y: auto;
            max-width: 600px; /* Adjust the width as needed */
            width: 100%;
        }

        .login-title {
            font-size: 30px;
            font-weight: bolder;
            text-align: center; /* Center horizontally */
            margin-bottom: 20px;
        }

        .input-group {
            width: 100%;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 75%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-group textarea {
            width: 75%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-group label {
            font-size: 18px;
            margin-bottom: 5px;
            display: block;
        }

        .form-login {
            margin-bottom: 50%;
        }

        .btn-login {
            background-color: #55459d;
            color: white;
            height: 3vh;
            width: 10vh;
        }

        .class-btn{
            /* text-align: center; */
        }
    </style>
    <title>Parent Registration</title>
</head>
<body>
    <div class="container">
        <img class="logo-pahang" src="https://www.pahang.gov.my/pahang/resources/MAIN_PAGE/Mengenai_Pahang/jata.png" alt="">
        <p class="title">KAFA Pahang</p>
    </div>
    
    <div class="content">
        <div class="inner-content">
            <h2>Create New Account</h2>
            <p style="">Already Registered? <a href="{{route('login')}}">Login</a></p>
            @if ($errors->any())
                <div class="alert alert-danger">
                 <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
                 </div>
             @endif
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" id="parents_name" name="parents_name" placeholder="NAME" autocomplete="off">
                </div>

                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="EMAIL" autocomplete="off">
                </div>

                <div class="input-group">
                    <input type="text" id="phonenumber" name="phonenumber" placeholder="PHONE NUMBER" autocomplete="off">
                </div>

                <div class="input-group">
                    <input type="text" id="studentno" name="studentno" placeholder="STUDENTNO" autocomplete="off">
                </div>

                <div class="input-group">
                    <input type="text" id="studentname" name="studentname" placeholder="STUDENT NAME" autocomplete="off">
                </div>

                <div class="input-group">
                    <textarea name="student_address" placeholder="HOME ADDRESS" ></textarea>
                </div>

                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="PASSWORD" autocomplete="off">
                </div>

                {{-- password_confirmation --}}

                <div class="input-group">
                    <input type="password" id="password_confirmation " name="password_confirmation" placeholder="PASSWORD CONFIRMATION" autocomplete="off">
                </div>
          

                <input type="hidden" name="role" value="parentStudent">

                <div class="class-btn">
                    <button class="btn-login" type="submit">Submit</button>
                </div>
                


            </form>
        </div>
    </div>

    <div class="footer">
        
    </div>
</body>
</html>
