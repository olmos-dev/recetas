<template>
     <button type="submit" class="btn btn-danger btn-block" @click="eliminarReceta">Eliminar &times;</button>
</template>

<script>
export default {
    props:['recetaId'],
    mounted(){
        console.log('Receta');
    },
    methods:{
        eliminarReceta(){
            Swal.fire({
                title:'¿Quieres eliminar está receta?',
                text: 'No se pueden deshacer los cambios',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'Cancelar',
                confirmButtonText: 'Eliminar',
               
            }).then((result)=>{
                if(result.value){
                    const params={
                        id:this.recetaId
                    }
                    /**Enivar la peticion al servidor con axios*/
                    axios.post(`recetas/${this.recetaId}`,{params,_method:'delete'})
                        .then(respuesta =>{
                            /**La respuesta procesada por el servidor*/
                            //console.log(respuesta);
                             Swal.fire({
                                title:'Eliminado',
                                text: 'La receta se elimino correctamente',
                                icon: 'success',    
                            })
                            /**Eliminar del DOM*/
                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                        })
                        .catch(error=>{
                            //console.log(error)
                                Swal.fire({
                                title:'Error',
                                text: 'Inténte más tarde',
                                icon: 'error',
                            
                            })
                        })
                }
            })

        }
    }
}
</script>