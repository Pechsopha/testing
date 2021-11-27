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
            z-index: 100;
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
            height: 80vh;
            background: #fff;
            padding: 15px;
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
        .popup-ads .popup-content img{
			width: 100%;
            height: calc(100% - 35px);
        }
        .close-btn{
           display: block;
            position: absolute;
            right: 5px;
            cursor: pointer;
            width: fit-content;
            color: crimson;
            font-size: 22px;
        }
		
		@media screen and (max-width: 576px) {
			.popup-ads .popup-content {
				height: 60vh;
			}
		}
		
		@media screen and (max-width: 480px) {
			.popup-ads .popup-content {
				height: 50vh;
			}
		}
     </style>
</head>
<body class="home blog ">
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
         <div class="popup-ads">
            <div class="popup-content">
                <div class="popup-header">
                    <p>Ads will close <span timeCloe></span>s</p>
                    <i class="close-btn fa fa-times"></i>
                </div>

            </div>
         </div>
        <div class="container">
            <section class="home-wrap">
                <section class="container">
                    {!! do_shortcode('[featured-posts][/featured-posts]') !!}
                    <section class="primary fleft">
                        {!! Theme::content() !!}
                    </section><!-- end .primary -->
                    <aside class="sidebar fright">
                        {!! dynamic_sidebar('primary_sidebar') !!}
                    </aside><!-- end .sidebar -->
                    <section class="cboth"></section><!-- end .cboth -->
                </section><!-- end .container -->
            </section><!-- end .home-wrap -->
        </div>

        {!! Theme::partial('footer') !!}

        {!! Theme::footer() !!}
        <script>
            $(document).ready(function(){
               getListAdvs();
                $('.popup-ads .close-btn').on('click', () => {
					$('.popup-ads').removeClass('active');
				});
            });

            function getListAdvs(){
                $.ajax({url: "https://www.alynana.com/advlist/getadvs", success: function(result){
                        var list = result.data;
                        $.each(list, function(index, value) {
                            var html = '';
                            if(value.istop == 1){
                                let i = 6;
                                html = '<a href="'+value.link+'"><img src="/storage/'+value.image+'" alt="'+value.name+'"/> </a>';
                                $('.popup-content').append(html);
                                $('.popup-ads').addClass('active');
								setInterval(() => {
									$('.popup-ads').find('[timeCloe]').text(i--);
									if (i < 0) {
										$('.popup-ads').removeClass('active');
									}
								}, 1000);
                            }
						});
						$('.popup-ads .close-btn').on('click', () => {
							$('.popup-ads').removeClass('active');
						});
                    }
				});
            }
        </script>
    </body>
</html>
