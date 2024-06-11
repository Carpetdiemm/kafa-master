<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            overflow: hidden; /* Prevent scrolling */
        }

        .title {
            color: white;
            font-size: 40px;
            /* padding-top: 4%; */
            padding-left: 2%;
            font-weight: bolder;
        }

        .container{
            background-color: #55459d;
            height: 15vh;
            display: flex;
        }
        .logo-pahang{
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
        .content{
            display: flex;
        }

        .left{
            background-color: #cac1ee;
            width: 50%;
            height: 90vh;
            padding: 20px;
            overflow-y: auto; /* Add scroll if content exceeds container height */
        }

        .right{
            width: 50%;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center vertically */
            align-items: center; /* Center horizontally */
            padding: 20px;
        }

        .login-title{
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
            width: 100%;
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

        .form-login{
            margin-bottom: 50%;
        }

        .btn-login{
            background-color: #55459d;
            color: white;
            height: 3vh;
            width: 10vh;
        }

        .error{
            color:red;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <img class="logo-pahang" src="https://www.pahang.gov.my/pahang/resources/MAIN_PAGE/Mengenai_Pahang/jata.png" alt="">
        <p class="title">KAFA Pahang</p>
    </div>
    
    <div class="content">
        <div class="left">
            <p>
                Kelas Al Quran dan Fardu Ain (KAFA) bermaksud kelas pengajian Al-Quran dan Fardu Ain bermula tahun 1 
                hingga 6 yang berdaftar dengan Agensi Pelaksana(Pihak Berkuasa Agama Negeri) dengan mengunapakai kurikulum,buku teks,peperiksaan Ujian Penilaian Kelas KAFA (UPKK)
                dan Pembelajaran (PdP) yang ditetapkan oleh Jabatan Kemajuan Islam Malaysia (JAKIM) dan elaun Guru KAFA 
                dibayar oleh Kerajaan Perseketuan melalui JAKIM.
            </p>
            <br>
            Sample Login Credential
            <hr>
            <b>Muip Admin</b>
            <table border=1>
                <tr>
                    <td>Staff ID</td>
                    <td>111</td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>12345</td>
                </tr>
            </table>
            <br>
            <b>Kafa Admin</b>
            <table border=1>
                <tr>
                    <td>Staff ID</td>
                    <td>222</td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>12345</td>
                </tr>
            </table>
            <br>
            <b>Teacher</b>
            <table border=1>
                <tr>
                    <td>Staff ID</td>
                    <td>991224055820</td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>12345</td>
                </tr>
            </table>

            
        </div>
        <div class="right">
            <p class="login-title">Admin/Teacher Login</p> 
            <!-- <p>Don't have an account? <a href="{{route('register')}}">Sign Up</a></p> -->
            <form action="{{ route('login') }}" class="form-login" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" id="studentID" name="userid" placeholder="Staff ID" required>
                </div>

                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
         
                </div>
                @if (session('error'))
                <p class="error">
                   {{ session('error') }}
                </p>
                @endif


                Login as :
                <input type="radio" id="radteacher" name="role" value="teacher" required> Teacher
                <input type="radio" id="radadmin" name="role" value="kafaAdmin" required> KAFA Admin
                <input type="radio" id="radadmin" name="role" value="muipAdmin" required> MUIP Admin

                <br><br>
                <!-- Add more input fields if needed -->
                <button class="btn-login" type="submit">Submit</button>
                <a href="{{url('/')}}" style="margin-left:200px">Parent Login</a>
            </form>
        </div>
    </div>

    <div class="footer">
        
    </div>
</body>
</html>
