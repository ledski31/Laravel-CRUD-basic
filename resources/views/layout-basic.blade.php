<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
		<meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel</title>
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<!-- Styles -->
		<style>
			html {
				margin: 0;
				padding: 0;
			}
			body {
				background-color: #fff;
					color: #636b6f;
					font-family: 'Nunito', sans-serif;
					font-weight: 200;
					margin: 1em;
					margin-bottom: 0;
         	}

            .full-height {
         		height: 100vh;
            }

            .flex-center {
					align-items: center;
					display: flex;
					justify-content: center;
            }

            .position-ref {
					position: relative;
            }

            .top-right {
					position: absolute;
					right: 10px;
					top: 18px;
            }

            .content {
					text-align: center;
            }

            .title {
					font-size: 84px;
            }

            .links > a {
					color: #636b6f;
					padding: 0 25px;
					font-size: 13px;
					font-weight: 600;
					letter-spacing: .1rem;
					text-decoration: none;
					text-transform: uppercase;
            }

            .m-b-md {
					margin-bottom: 30px;
            }

				fieldset {
    				border: 1px solid #c0c0c0;
    				margin: 0 2px;
    				padding: .35em .625em .75em;
				}
				legend {
					font-weight: bold;
				}
        </style>
	</head>
	<body>
		@yield('body')
	</body>
</html>