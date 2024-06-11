<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .content {
            padding: 30px;
            flex: 1;
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

        /* flash message */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            position: relative;
            opacity: 1;
            transition: opacity 0.5s linear;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 600px;
            margin: 20px auto;
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
           
        }

        .alert.hide {
            opacity: 0;
        }

        .alert .close {
            background-color: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="https://www.pahang.gov.my/pahang/resources/MAIN_PAGE/Mengenai_Pahang/jata.png" style="border-radius:50%" alt="Logo">
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
        <a href="{{route('view_profile')}}">PROFILE</a>
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
            <!-- @if (session('success'))
                <div class=" success">
                    {{ session('success') }}
                </div>
            @endif -->
        <!-- Content goes here -->
   
        @if(session('success'))
        <div class="alert">
        {{ session('success') }}
            <span class="close">&times;</span>
        </div>
        @endif
    </div>
</body>
</html>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.querySelector('.alert');
            const closeBtn = document.querySelector('.alert .close');

            if (alert) {
                // Close the alert when the close button is clicked
                closeBtn.addEventListener('click', function () {
                    alert.classList.add('hide');
                    setTimeout(function () {
                        alert.remove();
                    }, 500);
                });

                // Automatically close the alert after 3 seconds
                setTimeout(function () {
                    alert.classList.add('hide');
                }, 3000); // Adjust the time (in milliseconds) as needed

                setTimeout(function () {
                    alert.remove();
                }, 3500); // Slightly longer to ensure the fade-out is complete
            }
        });
    </script>