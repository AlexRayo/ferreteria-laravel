<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Formulario de prueba con vue</div>

                    <div class="panel-body">
                       <form action="./api/producto" method="POST" @submit.prevent="addTask">
                            <div class="form-group">
                              <input type="text" name="producto" v-model="producto" class="form-control" placeholder="Input task">                            
                            </div>
                            <div class="form-group">
                              <input type="submit" value="Add Task" class="btn btn-primary">                            
                            </div>
                       </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                producto:''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            addTask(){
            //función llamada desde el form
                //axios.post('./api/producto',{title:this.title});//api route link, title.this.tittle hace referencia al dato restornado en el método data()
                alert(this.producto);
               //axios.post('./api/producto').then(response => console.log(response.data));
            }
        },
    }
</script>
