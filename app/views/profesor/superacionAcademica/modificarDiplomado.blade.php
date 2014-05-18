@extends('layout.plantillaGenerica')
@section('titulo')
	Mi solicitud
@stop
@section('estilo')
.gallery
{
    display: inline-block;
    margin-top: 20px;
}
@stop
@section('script')
<script>
	$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
   
</script>
<link rel="stylesheet" href="//frontend.reklamor.com/fancybox/jquery.fancybox.css" media="screen">
<script src="//frontend.reklamor.com/fancybox/jquery.fancybox.js"></script>
@stop

@section('contenido')
	<div class="row">
		<div class="text-center">
			<div class='list-group gallery'>
				<div class='col-sm-4 col-xs-6 col-md-3 col-lg-6'>
					<a class="thumbnail fancybox" rel="ligthbox" href="{{asset('imagenes/IPN.jpeg')}}">
						{{HTML::image('imagenes/IPN.jpeg','Diploma',array('class'=>'img-responsive'))}}
						<div class='text-right'>
							<small class='text-muted'>Diploma</small>
						</div> <!-- text-right / end -->
					</a>
				</div> <!-- col-6 / end -->
				<div class='col-sm-4 col-xs-6 col-md-3 col-lg-6'>
					<a class="thumbnail fancybox" rel="ligthbox" href="{{asset('imagenes/IPN.jpeg')}}">
						{{HTML::image('imagenes/IPN.jpeg','Constancia',array('class'=>'img-responsive'))}}
						<div class='text-right'>
							<small class='text-muted'>Constancia</small>
						</div> <!-- text-right / end -->
					</a>
				</div> <!-- col-6 / end -->            
			</div> <!-- list-group / end -->
		</div>
	</div> <!-- row / end -->
	
	
	<form>
		<br /><br />
            


            <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Datos Generales</h3>
                </div>
            </div>
            
			<div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Nombre del diplomado</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="nombre" placeholder="Ingeniería de Software" class="form-control input-md" type="text" required>                    
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>		



            <br /><br />


			<div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Nombre de la Institución</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="nombreInstitucion" value="{{Form::old('nombreInstitucion')}}" placeholder="eS" class="form-control input-md" type="text" required>                    
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>		



            <br /><br />



            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="numero">Numero de horas</label>  
                  <div class="col-md-9">
                    <input id="textinput" value="{{Form::old('noHoras')}}" name="noHoras" placeholder="Ingresa el número de horas" class="form-control input-md" type="text" required>                    
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>



            <br /><br />







            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha de inicio</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaInicio" value="{{Form::old('fechaInicio')}}" placeholder="Ingresa la fecha de inicio del diplomado" class="form-control input-md" type="date">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>


            <br /><br />         






            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha de termino</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaTermino" value="{{Form::old('fechaTermino')}}" placeholder="Ingresa la fecha de termino del diplomado" class="form-control input-md" type="date">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>


            <br /><br />

            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="avance">Nivel</label>
                  <div class="col-md-9">
                    <select id="avance" name="nivel" class="form-control">
                      <option value="DES">DES</option>
                      <option value="DEMS">DEMS</option>
                      <option value="SIP">SIP</option>                                            
                    </select>
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>


            <br />
            <br />
            


            <div class="row">
              <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>Constancia de validación</h3>
                </div>
              </div>
              <div class="col-md-2"> </div>

              <div class="col-md-4"> 

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Numero</label>  
                  <div class="col-md-9">
                    <input id="textinput" value="{{Form::old('noConstancia')}}" name="noConstancia" placeholder="Ingresa el numero de la constancia" class="form-control input-md" type="text">                    
                  </div>
                </div> 


              </div>
              
              <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>  
                  <div class="col-md-9">
                    <input id="textinput" name="fechaConstancia" value="{{Form::old('fechaConstancia')}}"  placeholder="Ingresa la fecha de la constancia" class="form-control input-md" type="date">                    
                  </div>
                </div> 

              </div>

              <div class="col-md-2"> </div>
              
            </div>            



            <br /><br />




            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="constancia">Constancia de validación</label>
                  <div class="col-md-9">
                    {{Form::file('constanciaFile')}}
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>            
			
			
			
			<br />
			<br />			
			
			<div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="avance">Diploma</label>
                  <div class="col-md-9">
                    {{Form::file('diplomaFile')}}
                  </div>
                </div>    


              </div>
              <div class="col-md-2"> </div>
            </div>
			
			<br />
			<br />
			
	
	</form>
	
	
@stop