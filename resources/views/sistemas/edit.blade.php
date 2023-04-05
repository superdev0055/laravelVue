<!-- Modal -->
<form method="POST" v-on:submit.prevent="updateSistema(sistema.codiSistema)">
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar Sistema</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">                    
                            <div class="form-group">
                                <label for="nombreSiste">Nombre de sistema</label>
                                <input type="text" 
                                name="nombreSiste"
                                class="form-control" 
                                id="nombreSiste" 
                                aria-describedby="sistemalHelp" 
                                placeholder="sistema"
                                v-model="sistema.nombreSiste">
                              <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                            </div>
                            <div class="form-group">
                                <label for="nombreBreveSiste">Nombre breve</label>
                                <input type="text"
                                name="nombreBreveSiste"
                                class="form-control" 
                                id="nombreBreveSiste" 
                                aria-describedby="brevelHelp" 
                                placeholder="nombre breve"
                                v-model="sistema.nombreBreveSiste">
                                <small id="brevelHelp" class="form-text text-muted">Campo requerido.</small>
                            </div>
                            <div class="form-group">
                              <label for="fechaCreaSiste">Fecha</label>
                              <input type="date"
                              name="fechaCreaSiste"
                              class="form-control" 
                              id="fechaCreaSiste" 
                              aria-describedby="fechaHelp" 
                              placeholder="nombre breve"
                              v-model="sistema.fechaCreaSiste">
                          </div>
                            <div class="form-group">
                                <label for="estaSiste">Estado</label>
                                <select name="estaSiste" 
                                class="form-control"
                                id="estaSiste"
                                v-model="sistema.estaSiste">
                                  <option value="1">ACTIVADO</option>
                                  <option value="0">DESACTIVADO</option>
                                </select>
                            </div>
                        
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
              </div>
            </div>
          </div>
        </form>