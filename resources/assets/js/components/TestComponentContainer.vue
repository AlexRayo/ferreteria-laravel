<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Productos :v</div>

                    <div class="panel-body">

                    <test-form @new="agregarProducto"></test-form>

                    <producto-component
                        v-for="(producto, index) in productos"
                        :key="producto.id"
                        :producto="producto"
                        @update="updateProducto(index, ...arguments)"
                        @delete="deleteProducto(index)">
                    </producto-component>

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
