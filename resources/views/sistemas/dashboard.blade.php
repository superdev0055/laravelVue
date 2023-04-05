@extends('app')

@section('content')

<div class="row m-5" id="crud">
    <div class="col-md-12">
        <h1 class="page-header">Gestión de Sistemas</h1>
    </div>
    <hr>
    <div class="col-8">
            <a class="btn btn-outline-primary pull-right m-2" data-toggle="modal" data-target="#create">
              Nuevo Sistema
            </a>
            @include('sistemas.create')
            @include('sistemas.edit')
            <table class="table table-bordered table-hover">
                    <thead>
                      <tr class="table-active">
                        <th scope="col">Sistema</th>
                        <th scope="col">Nombre Breve</th>
                        <th scope="col">Fecha creación</th>
                        <th scope="col">Estado</th>
                        <th colspan="2" scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="sistema in sistemas">
                      <th scope="row">@{{ sistema.nombreSiste }}</th>
                      <td>@{{ sistema.nombreBreveSiste }}</td>
                      <td>@{{ sistema.fechaCreaSiste }}</td>
                      <td>@{{ sistema.estaSiste }}</td>
                        <td>
                          {{-- <a  v-on:click.prevent="editSistema(sistema)">Editar</a> --}}
                          <a class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#edit" v-on:click.prevent="editSistema(sistema)">
                            Editar
                          </a>
                        </td>
                        <td>
                          <a class="btn btn-outline-danger btn-sm" v-on:click.prevent="deleteSistema(sistema)">Eliminar</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">Atras</a>
                      </li>
                      <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]">
                        <a class="page-link" href="#" @click.prevent="changePage(page)">@{{ page }}</a>
                      </li>
                      <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">Siguiente</a>
                      </li>
                    </ul>
                  </nav>
    </div>
    <div class="col-4">
      <pre>
        @{{ $data }}
      </pre>
    </div>    
</div>

<script src="{{ asset('./js/app.js') }}"></script>
@endsection