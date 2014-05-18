<br /><br />
             
            
            <div class="row">
                <div class="row">
                    <div class="col-md-5 col-md-offset-5">
                        <h3>Periodo</h3>
                    </div>
                </div>
                <div class="col-md-2"> </div>
                
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="claveRegistro">Inicio</label>
                        <div class="col-md-9">
                            <input id="textinput" name="fechaInicio" value="{{$resultado['fechaInicio']}}" placeholder="Ingresa la fecha de inicio" class="form-control input-md" type="date" disabled>
                        </div>
                    </div>
                    
                    
                </div>
                
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="claveRegistro">Término</label>
                        <div class="col-md-9">
                            <input id="textinput" name="fechaTermino" value="{{$resultado['fechaTermino']}}" placeholder="Ingresa la fecha de termino" class="form-control input-md" type="date" disabled>
                        </div>
                    </div> 
                    
                </div>
                
                <div class="col-md-2"> </div>
                
            </div>


            <br /><br />
            
            
            <div class="row">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <h3>Constancia de impartición</h3>
                    </div>
                </div>
                <div class="col-md-2"> </div>
                
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="claveRegistro">Numero</label>
                        <div class="col-md-9">
                            <input id="textinput" name="noConstancia" value="{{$resultado['noConstancia']}}" placeholder="D/ESCOM/ICFIM/01/201" class="form-control input-md" type="text" disabled>
                                </div>
                    </div>
                    
                    
                </div>
                
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="claveRegistro">Fecha</label>
                        <div class="col-md-9">
                            <input id="textinput" name="fechaConstancia" value="{{$resultado['fechaConstancia']}}" placeholder="Ingresa la fecha de fin" class="form-control input-md" type="date" disabled>
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
                        <label class="col-md-3 control-label" for="avance">Evaluación</label>
                        <div class="col-md-9">
                            <input id="textinput" name="evaluacion" value="{{$resultado['evaluacion']}}" placeholder="Ejemplo: 48" class="form-control input-md" type="text" disabled>
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
                        <label class="col-md-3 control-label" for="numero">Horas de duración</label>
                        <div class="col-md-9">
                            <input id="textinput" name="noHoras" value="{{$resultado['horasDuracion']}}" placeholder="Ejemplo: 48" class="form-control input-md" type="text" disabled>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-md-2"> </div>
            </div>
            
            
            <br /><br />