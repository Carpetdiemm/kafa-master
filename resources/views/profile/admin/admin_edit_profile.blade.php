<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #d3b5fa;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            box-sizing: border-box;
        }
        .sidebar img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
            border-radius: 50%;
        }
        .sidebar h2 {
            color: #000000;
            margin: 0;
            font-size: 1.2em;
            text-align: center;
            padding: 0 15px;
            box-sizing: border-box;
        }
        .sidebar p {
            color: #9172c2;
            margin-top: 5px;
            margin-bottom: 20px;
            font-size: 1em;
            text-align: center;
            padding: 0 15px;
            box-sizing: border-box;
        }
        .sidebar a {
            text-decoration: none;
            color: #000000;
            background-color: #e7d8fa;
            width: 100%;
            padding: 15px;
            text-align: center;
            border: none;
            outline: none;
            font-size: 1em;
            box-sizing: border-box;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .sidebar a:hover {
            background-color: #d3b5fa;
        }
        .sidebar a.active {
            background-color: #8676cc;
            color: #ffffff;
        }
        .sidebar a.logout {
            margin-top: auto;
            background-color: #bfa2e1;
        }
        .sidebar a.logout:hover {
            background-color: #9d82c1;
        }
        .content {
            padding: 30px;
            flex: 1;
        }
        .profile-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .profile-card h2 {
            color: #55459d;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #55459d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #423684;
        }
        .form-group textarea {
            width: 75%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="https://www.pahang.gov.my/pahang/resources/MAIN_PAGE/Mengenai_Pahang/jata.png" alt="Logo">
        <h2>KAFA PAHANG</h2>
        <p>KAFA 

        @if(Auth::User()->userrole == 'teacher')

            Teacher

            @endif

            @if(Auth::User()->userrole == 'parentStudent')

            Parent

            @endif

            @if(Auth::User()->userrole == 'kafaAdmin')

            Admin

            @endif

            @if(Auth::User()->userrole == 'muipAdmin')

            Muip Administrator

            @endif
        </p>
        <a href="{{ route('view_profile') }}" class="active">PROFILE</a>
        <a href="#activity">ACTIVITY</a>
        <a href="#results">RESULTS</a>
        <a href="#payment">PAYMENT</a>
        <a href="#report">REPORT</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">LOGOUT</a>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div class="content">
        <!-- <h1>WELCOME : <b style="color:#55459d">{{ Auth::User()->name }}</b></h1> -->
        
        <h1>UPDATE PROFILE MODULE FOR {{ strtoupper($role) }}</h1>

        <div class="profile-card">
            <h2>Edit Profile</h2>
            <form action="{{route('adminupdateprofileformpost')}}" method="POST">
                @csrf
                <!-- Assuming $profile contains the profile data -->

                @if($role == 'parent')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{$parentData->name}}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phonenumber" name="phonenumber" value="{{$parentData->parent_phone_numb}}" required>
                </div>

                <div class="form-group">
                    <label for="name">Email:</label>
                    <input type="text" id="email" name="email" value="{{$parentData->email}}" required>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <input type="text" id="role" name="role" value="{{$role}}" readonly>
                </div>

                <input type="hidden" name="userID" value="{{$parentData->userID}}">

                <input type="hidden" name="id" value="{{$parentData->pId}}">
                @endif

                @if($role == 'student')
                <div class="form-group">
                    <label for="studentName">Name:</label>
                    <input type="text" id="studentName" name="studentName" value="{{$studentData->student_name}}" required>
                </div>

                <div class="form-group">
                    <label for="studentNum">Student Number:</label>
                    <input type="text" id="studentNum" name="studentNum" value="{{$studentData->student_ic}}" readonly>
                </div>

                <div class="form-group">
                    <label for="studentNum">Student Address:</label>
                    <textarea name="student_address" id="" required>{{$studentData->student_address}}</textarea>
                </div>

                <input type="hidden" id="role" name="role" value="student" >

                @endif


               

              
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>
