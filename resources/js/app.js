new Vue({
    el: '#crud',
    created: function(){
        this.getSistemas();
    },
    data: {
        sistemas: [],
        pagination:{
            'total' : 0,
            'current_page' : 0,
            'per_page': 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0
        },
        nombreSiste:'',
        nombreBreveSiste:'',
        fechaCreaSiste:'',
        estaSiste:'',
        sistema:{
            codiSistema:'',
            nombreSiste:'',
            nombreBreveSiste:'',
            fechaCreaSiste:'',
            estaSiste:''
        },
        offset:3,
        errors:[]
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function(){
            if(!this.pagination.to){
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];

            while(from <= to){
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        }
    },
    methods: {
        getSistemas: function(page){
            var urlSistemas = '/sistemas?page='+page;
            axios.get(urlSistemas).then( response => {
                this.sistemas = response.data.sistemas.data,
                this.pagination = response.data.pagination
            });

        },
        deleteSistema: function(sistema){
            var url = '/sistemas/'+sistema.codiSistema;
            axios.delete(url).then( response => {
                this.getSistemas();
                toastr.success('Eliminado correctamente');
            });
        },
        createSistema: function(){
            var url = "/sistemas";
            axios.post(url, {
                nombreSiste: this.nombreSiste,
                nombreBreveSiste: this.nombreBreveSiste,
                fechaCreaSiste: this.fechaCreaSiste,
                estaSiste: this.estaSiste
            }).then( response => {
                this.getSistemas();
                this.nombreSiste = '';
                this.nombreBreveSiste = '';
                this.fechaCreaSiste = '',
                this.estaSiste = '';
                this.errors = [],
                $('#create').modal('hide');
                toastr.success('Nuevo sistema creado');
            } ).catch(error =>{
                this.errors = error.response.data;
            });
        },
        editSistema: function(sistema){
            this.sistema.codiSistema = sistema.codiSistema;
            this.sistema.nombreSiste = sistema.nombreSiste;
            this.sistema.nombreBreveSiste = sistema.nombreBreveSiste;
            this.sistema.fechaCreaSiste = sistema.fechaCreaSiste;
            this.sistema.estaSiste = sistema.estaSiste;
            $('#edit').modal('show');
            console.log(sistema.codiSistema);
        },
        updateSistema: function(codiSistema){
            var url = '/sistemas/'+codiSistema;
            axios.put(url, this.sistema).then( response => {
                this.getSistemas();
                this.sistema = {
                    codiSistema:'',
                    nombreSiste:'',
                    nombreBreveSiste:'',
                    fechaCreaSiste:'',
                    estaSiste:''
                };
                this.errors = [];
                $('#edit').modal('hide');
                toastr.success('Sistema actualizado');
            }).catch( error=>{
                this.errors = error.response.data
            });
        },
        changePage: function(page){
            this.pagination.current_page = page;
            this.getSistemas(page);
        }
    }


});