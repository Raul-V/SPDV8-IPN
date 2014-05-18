@extends('layout.registroDocumentos')

@section('titulo')
  Registrar Propuesta certámenes Académicos.
@stop

@section('nombreUsuario')
  {{Auth::user()->nombre}} <!--No cambiar esta seccion -->
@stop

@section('tituloForm')
  Registrar Propuesta Certámenes Académicos
@stop

@section('formulario')
  
  <br /><br />
      
      
            <div class="row">
      
            <div class="row">
                <div class="col-md-5 col-md-offset-5">
                  <h3>oficio</h3>
                </div>
              </div>
  
               <div class="row">
              <div class="col-md-2"> </div>
             

            
               <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaevento">Fecha evento</label>  
                  <div class="col-md-9">
                    <input id="fechaevento" name="fechaevento" value="{{Form::old('fechaevento')}}" placeholder="Fecha de paticipación" class="form-control input-md" type="date">                    
                  </div>
                </div> 

              </div>  


                <div class="col-md-2"> </div>
            </div>


            <br /><br />
                   <div class="row">
              <div class="col-md-2"> </div>
             

            
               <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaDes">Fecha designación</label>  
                  <div class="col-md-9">
                    <input id="fechaDes" name="fechaDes" value="{{Form::old('fechaDes')}}" placeholder="Ingresa la fecha de designación de puesto" class="form-control input-md" type="date">                    
                  </div>
                </div> 

              </div>  


                <div class="col-md-2"> </div>
            </div>

            <br /><br />


                <div class="row">
              <div class="col-md-2"> </div>
             

            
               <div class="col-md-4">

                <div class="form-group">
                 <label class="col-md-3 control-label" for="numeroDes">Número Designación</label>  
                  <div class="col-md-9">
                    <input id="numeroDes" name="numeroDes" value="{{Form::old('numeroDes')}}" placeholder="Número de designación" class="form-control input-md" type="text">                    
                  </div>
                </div> 

              </div>  


                <div class="col-md-2"> </div>
            </div>





            <br /><br />



                <div class="row">
              <div class="col-md-2"> </div>
             

            
               <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="fechaPar">Fecha Participación</label>  
                  <div class="col-md-9">
                    <input id="fechaPar" name="fechaPar" value="{{Form::old('fechaPar')}}" placeholder="Ingresa la fecha de participación" class="form-control input-md" type="date">                    
                  </div>
                </div> 

              </div>  


                <div class="col-md-2"> </div>
            </div>


       
            <br /><br />
     


                <div class="row">
              <div class="col-md-2"> </div>
             

            
               <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="numeroPar">Número Participación</label>  
                  <div class="col-md-9">
                    <input id="numeroPar" name="numeroPar" value="{{Form::old('numeroPar')}}" placeholder="Número de participación" class="form-control input-md" type="text">                    
                  </div>
                </div> 

              </div>  


                <div class="col-md-2"> </div>
            </div>



            <br /><br />


                <div class="row">
              <div class="col-md-2"> </div>
             

            
               <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="area">Área de especialidad</label>  
                  <div class="col-md-9">
                    <input id="area" name="area" value="{{Form::old('area')}}" placeholder="Ingresa el área de especialidad" class="form-control input-md" type="text">                    
                  </div>
                </div> 

              </div>  


                <div class="col-md-2"> </div>
            </div>








            <br /><br />


           
                <div class="row">
              <div class="col-md-2"> </div>
             

            
               <div class="col-md-4">

                <div class="form-group">
                  <label class="col-md-3 control-label" for="tipo">Tipo del evento evaluado</label>  
                  <div class="col-md-9">
                    <input id="tipo" name="tipo" value="{{Form::old('tipo')}}" placeholder="Ingresa el tipo del evento evaluado" class="form-control input-md" type="text">                    
                  </div>
                </div> 

              </div>  


                <div class="col-md-2"> </div>
            </div>



            

            <br /><br />


       

            

          
            </div>



            <br /><br />


            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">


                <div class="form-group">
                  <label class="col-md-3 control-label" for="constanciaFile">Constancia de validación</label>
                  <div class="col-md-9">
                    <input id="constanciaFile" name="constanciaFile" value="{{Form::old('constanciaFile')}}" class="input-file" type="file">
                  </div>
                </div>


              </div>
              <div class="col-md-2"> </div>
            </div>




            <br /><br />

  
  
  
  
@stop
 