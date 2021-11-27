<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="{{ app()->getLocale() }}" prefix="og: http://ogp.me/ns#">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="canonical" href="{{ route('public.single') }}">
    <meta http-equiv="content-language" content="en">

    {!! Theme::header() !!}
      <style>
        html {
            overflow-y: scroll;
        }
        .popup-ads {
            visibility: hidden;
            -webkit-transition: .3s;
            transition: .3s;
            opacity: 0;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(0,0,0,.5);
            z-index: 100000000000000000;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
        .popup-ads .popup-content {
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            background: #fff;
            position: relative;
			margin: 20px;
        }
        .popup-ads .popup-content .popup-header {
            background: #fff;
            width: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            padding: 5px 0;
        }
        .popup-ads.active{
            visibility: visible;
            opacity: 1;
        }
        .popup-ads .popup-content img {
			width: 700px;
            height: auto;
        }

        .close-btn{
            position: absolute;
            right: 0;
            top: 0;
            padding: .5rem;
        }

        .close-btn:focus {
            box-shadow: none;
        }
		
		@media (max-width: 576px) {
            .popup-ads .popup-content img {
                width: 100%;
                height: auto;
            }
        }
     </style>
</head>
<body class="home blog">
    <script>
        function showPopup() {
            document.querySelector('.popup-ads .close-btn').addEventListener('click', () => {
                document.querySelector('.popup-ads').classList.remove('active');
            });

            document.querySelector('.popup-ads').classList.add('active');

            let countdown = 5;
            const timer = setInterval(() => {
                document.querySelector('.popup-ads [timeCloe]').textContent = countdown--;
                if (countdown < 0) {
                    document.querySelector('.popup-ads').classList.remove('active');
                    clearInterval(timer);
                }
            }, 1000);
        }
    </script>
    <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId            : '226300418483336',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v7.0'
          });
        };
      </script>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

        {!! Theme::partial('header') !!}
        
        {!! Theme::content() !!}

        {!! Theme::partial('footer') !!}

        {!! Theme::footer() !!}
    
    </body>
</html>
