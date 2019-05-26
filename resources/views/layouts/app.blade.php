<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comenzi online</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link href="/fontawesome.min.css" rel="stylesheet">
    
    <link href="/bootstrap.min.css" rel="stylesheet">
    
    <link href="/jqueryui.css" rel="stylesheet">

    
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        
        .navbar a {
            color: white;
        }
        
        .navbar a:hover, .navbar a:focus {
            color: #23527c;
        }
        
        .no-hover:hover {
            color:inherit!important;
        }
        
        .jumbotron p {
            font-weight:300;
        }
        
        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
        
        .input-group-addon {
            min-width:135px;
        }
        
        #order .input-group {
            margin-bottom:20px;
        }
        
        .table>tbody>tr>td {
            vertical-align: middle;
        }
        
        #app-layout > .container {
            padding-bottom: 40px;
        }
        
        .perclient-actions{
            position: fixed;
            background-color: white;
            width: 100%;
            padding-bottom: 20px;
        }
        
        .perclient-actions.fixed {
            top:0;
            animation: smoothScroll 1s forwards;
        }
        
        .perclient-search.fixed {
            top:115px;
            animation: smoothScroll 1s forwards;
        }

        .perclient-search{
            position: fixed;
            background-color: white;
            top: 180px;
            width: 100%;
        }
        
        .perclient-table{
            margin-top:225px;
        }
        
        @keyframes smoothScroll {
        	0% {
        		transform: translateY(-40px);
        	}
        	100% {
        		transform: translateY(0px);
        	}
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-dark bg-primary navbar-static-top" id="header">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand no-hover" href="{{ url('/') }}">
                    Comenzi online
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::check())
                        <li><a href="{{ url('/') }}"><i class="fa fa-btn fa-users"></i>Clienti</a></li>
<!--                         <li><a href="{{ url('/facturi') }}"><i class="fa fa-btn fa-th-list"></i>Comenzi</a></li> -->
                        <li><a href="{{ url('/subcontractor') }}"><i class="fa fa-btn fa-truck"></i>Subcontractori</a></li>
                        <li><a href="{{ url('/user') }}"><i class="fa fa-btn fa-user"></i>Utilizatori</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Logare</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Delogare</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-primary" style="z-index: 100;">
        <p style="margin: 5px 0">&copy;Copyright 2019 Radiasima Prod.</p>
    </footer>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!--<script src="/facturi/public/jqueryui.js"></script>-->
        <script src="/jqueryui.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
              dateFormat: "dd-mm-yy"
            });
            
            window.addEventListener('scroll', function() {
                  var distanceFromTop = $(this).scrollTop();
                  if (distanceFromTop >= $('#header').height()) {
                      $('.perclient-actions, .perclient-search').addClass('fixed');
                  } else {
                      $('.perclient-actions, .perclient-search').removeClass('fixed');
                  }
              });
              
              setTimeout(function() {
                $('.alert').fadeOut('fast');
            }, 3000);
        });
    </script>
</body>
</html>
