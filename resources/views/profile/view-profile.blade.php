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
            background-color: #f3f3f3;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .profile-card h2 {
            margin-top: 0;
            color: #55459d;
        }
        .profile-card p {
            margin: 5px 0;
        }
        .profile-card b {
            color: #55459d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #8676cc;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #E0E0E0;
        }
        .action {
            text-align: center;
        }
        .action img {
            width: 40px;
            height: 40px;
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
        <h1>WELCOME : <b style="color:#55459d">{{ Auth::User()->name }}</b></h1>
        <h3>List of Students</h3>
        
        @if(Auth::User()->userrole == 'parentStudent')

        <div class="profile-card">
            <h2>Student Profile</h2>
            <p><b>Name:</b> {{$data[0]->student_name}}</p>
            <p><b>Student Number:</b> {{$data[0]->student_ic}}</p>
            <p><b>Student Address:</b> {{$data[0]->student_address}}</p>
            <p><a href="{{route('update_profile_form',['role'=>'student'])}}">Edit</a></p>
            <!-- Add more fields as needed -->
        </div>
        <br>
        <div class="profile-card">
            <h2>Parent Profile</h2> 
            <p><b>Name:</b> {{ Auth::User()->name }}</p>
            <p><b>Phone Number:</b> {{$data2[0]->parent_phone_numb}}</p>
            <p><b>Email:</b> {{ Auth::User()->email }}</p>
            <p><b>Role:</b> {{ (Auth::User()->userrole) == 'parentStudent' ? 'Parent' : 'Admin' }}</p>
            <p><a href="{{route('update_profile_form',['role'=>'parent'])}}">Edit</a></p>
            <!-- Add more fields as needed -->
        </div>
        
        @else
                @if($data->isEmpty())
            <p>No data available.</p>
        @else
        <table>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAME</th>
            <th>HOME ADDRESS</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        
       @foreach($data as $key=>$item)

        <tr>
            <td>{{$key+1}}</td>
            <td>{{$item->student_name}}</td>
            <td>{{$item->student_address}}</td>
            <td class="action">
            
            
            <!-- <a href="{{route('adminUpdateProfile')}}">
            <img title="Edit Info" src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" style="cursor:pointer" alt="">
            </a>
            &nbsp -->
            <a href="{{route('adminViewProfile',['student_ic'=>$item->student_ic])}}">
            <img title="View Info" style="cursor:pointer" src="https://img.icons8.com/?size=100&id=Y1WI9qcs2l6I&format=png&color=000000" alt="">
            </a>
            <!-- https://img.icons8.com/?size=100&id=QFAMAEC2jXs6&format=png&color=000000 -->

            <img title="Delete User" class="btn-delete" data-user-name="{{$item->student_name}}" data-user-id="{{$item->student_ic}}" style="cursor:pointer" src="https://img.icons8.com/?size=100&id=QFAMAEC2jXs6&format=png&color=000000" alt="">

            <form id="delete-form" action="" method="POST" style="display: none;">
                 @csrf
                @method('DELETE')
             </form>
        </td>
        </tr>


       @endforeach
    </tbody>
</table>
        @endif
       
        
        @endif

       
     

     

    </div>
</body>
</html>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            const deleteForm = document.getElementById('delete-form');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.getAttribute('data-user-id');
                    const username = this.getAttribute('data-user-name');
                    if (confirm('Are you sure you want to delete '+username)) {
                        deleteForm.action = `/deleteUser/${userId}`;
                        deleteForm.submit();
                    }
                });
            });
        });
    </script>
