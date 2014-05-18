<!doctype html>
<html lang="es" ng-app>
<head>
	<meta charset="UTF-8">
	<title>@yield('titulo')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">    
	{{ HTML::style('css/bootstrap.min.css')}}
	{{ HTML::script('js/jquery.min.js') }}	
	{{ HTML::style('css/bootstrap-theme.css')}}
    {{ HTML::script('js/bootstrap.min.js') }}	   
	{{ HTML::script('js/bootstrap.js') }}
	{{ HTML::script('https://code.angularjs.org/1.2.9/angular.js')}}
	{{ HTML::script('js/jConfirmAction/jconfirmaction.jquery.js') }}	
	
	<style>
	/*
Credits:
https://github.com/marcaube/bootstrap-magnify
*/

.mag {
    width:200px;
    margin: 0 auto;
    float: none;
}
    
.mag img {
    max-width: 100%;
}
        
  

.magnify {
    position: relative;
    cursor: none
}

.magnify-large {
    position: absolute;
    display: none;
    width: 175px;
    height: 175px;

    -webkit-box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
       -moz-box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
            box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 0 0 7px 7px rgba(0, 0, 0, 0.25), inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
    
    -webkit-border-radius: 100%;
       -moz-border-radius: 100%;
             border-radius: 100%
}
	</style>
	
	<script>
		/*
Credits:
https://github.com/marcaube/bootstrap-magnify
*/


!function ($) {

    "use strict"; // jshint ;_;


    /* MAGNIFY PUBLIC CLASS DEFINITION
     * =============================== */

    var Magnify = function (element, options) {
        this.init('magnify', element, options)
    }

    Magnify.prototype = {

        constructor: Magnify

        , init: function (type, element, options) {
            var event = 'mousemove'
                , eventOut = 'mouseleave';

            this.type = type
            this.$element = $(element)
            this.options = this.getOptions(options)
            this.nativeWidth = 0
            this.nativeHeight = 0

            this.$element.wrap('<div class="magnify" \>');
            this.$element.parent('.magnify').append('<div class="magnify-large" \>');
            this.$element.siblings(".magnify-large").css("background","url('" + this.$element.attr("src") + "') no-repeat");

            this.$element.parent('.magnify').on(event + '.' + this.type, $.proxy(this.check, this));
            this.$element.parent('.magnify').on(eventOut + '.' + this.type, $.proxy(this.check, this));
        }

        , getOptions: function (options) {
            options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

            if (options.delay && typeof options.delay == 'number') {
                options.delay = {
                    show: options.delay
                    , hide: options.delay
                }
            }

            return options
        }

        , check: function (e) {
            var container = $(e.currentTarget);
            var self = container.children('img');
            var mag = container.children(".magnify-large");

            // Get the native dimensions of the image
            if(!this.nativeWidth && !this.nativeHeight) {
                var image = new Image();
                image.src = self.attr("src");

                this.nativeWidth = image.width;
                this.nativeHeight = image.height;

            } else {

                var magnifyOffset = container.offset();
                var mx = e.pageX - magnifyOffset.left;
                var my = e.pageY - magnifyOffset.top;

                if (mx < container.width() && my < container.height() && mx > 0 && my > 0) {
                    mag.fadeIn(100);
                } else {
                    mag.fadeOut(100);
                }

                if(mag.is(":visible"))
                {
                    var rx = Math.round(mx/container.width()*this.nativeWidth - mag.width()/2)*-1;
                    var ry = Math.round(my/container.height()*this.nativeHeight - mag.height()/2)*-1;
                    var bgp = rx + "px " + ry + "px";

                    var px = mx - mag.width()/2;
                    var py = my - mag.height()/2;

                    mag.css({left: px, top: py, backgroundPosition: bgp});
                }
            }

        }
    }


    /* MAGNIFY PLUGIN DEFINITION
     * ========================= */

    $.fn.magnify = function ( option ) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('magnify')
                , options = typeof option == 'object' && option
            if (!data) $this.data('tooltip', (data = new Magnify(this, options)))
            if (typeof option == 'string') data[option]()
        })
    }

    $.fn.magnify.Constructor = Magnify

    $.fn.magnify.defaults = {
        delay: 0
    }


    /* MAGNIFY DATA-API
     * ================ */

    $(window).on('load', function () {
        $('[data-toggle="magnify"]').each(function () {
            var $mag = $(this);
            $mag.magnify()
        })
    })

} ( window.jQuery );
	</script>
	
</head>
<body>
<!--Banner de la página-->
{{HTML::image('imagenes/bannerIPN.png','',array('class'=>'img-responsive'))}}

@section('navbar')
<!--Se hace la parte del menu -->	
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">    <!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav">
					<li><a href="{{action('ProfesorController@getIndex')}}"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
					<li><a href="{{action('ProfesorController@getPerfil')}}"><span class="glyphicon glyphicon-user"></span> Mi Perfil</a></li>      
					<li><a href="{{action('ProfesorController@getDocumentos')}}"><span class="glyphicon glyphicon-folder-close"></span> Mis documentos</a></li>
				  </ul>
			  
			  
			  <!--Barra de navegacion de la derecha-->
			  <ul class="nav navbar-nav navbar-right">
			   <li><a href="#">Ayuda</a></li>
			   <li><a href="{{action('LogoutController@getLogout')}}">Cerrar Sesión</a></li>
			   <p class="navbar-text navbar-right">Mi nombre es:<a href="#" class="bg-success"> {{Auth::user()->nombre}} </a></p>
			  </ul>
			</div>

		</div><!-- /.container-fluid -->
</nav>    
@show
<!-- -->
    <br />
    <br />
	
	<!--Aqui va el contenido de la página-->
    <div class="container">  	
	@if($messages=Session::get('messages'))	
		@foreach($messages as $message)
			<div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <center><strong>{{$message}}</strong></center>
			</div>
		@endforeach
	@endif
	@if($errors=Session::get('errores'))	
		@foreach($errors as $message)		
			<div class="alert alert-danger alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			  <center><strong>{{$message}}</strong></center>
			</div>
		@endforeach
	@endif
		<div class="panel panel-primary">
			<div class="panel-heading">@yield('tituloPanel')</div>
		  <div class="panel-body">
			
		  
				@yield('contenido')		
				<br />
				<br />
				<br />
				
			</div>
			@section('botones')
				<div class="row">
					<div class="col-md-2"> </div>
						<div class="col-md-8">

							<div class="form-group">                
							  <label class="col-md-4 control-label" for="registrar"></label>
							  <div class="col-md-8">
								<a href="#" name="registrar" id="eliminar" value="Modificar" class="btn btn-primary">Modificar</a>
								<a href="{{action('ProfesorController@getDocumentos')}}" class="btn btn-primary">Regresar</a>
								
							  </div>
							</div>  
						
						</div>
					<div class="col-md-2"> </div>
				</div>
			@show
				<br />
				<br />
				<br />
			  <div class="panel-footer">
				@yield('imagenes')
			  </div>
		</div>
		
		
		
    </div>
    
	
    

  

    
<script type="text/javascript">
			
			
			$(document).ready(function() {
				
				
				$('#eliminar').click(function(e) {
					
					e.preventDefault();
					thisHref	= $(this).attr('href');
					
					if(confirm('¿Estas seguro que deseas modificar el documento?')) {
						window.location = thisHref;
					}
					
				});				
				
			});
		</script> 

</body>
</html>
