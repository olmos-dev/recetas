<template>
    <div>
        <span class="like-btn" @click="darLike" :class="{'like-active':this.like}"></span>
        <p class="">{{cantidadLikes}} les gustó está receta</p>
        
    </div>
</template>

<script>
export default {
    props:['recetaId','like','contarLikes'],
    /**Se define las variables donde el valor se modificara dinamicamente*/
    data: function(){
        return {
            totalLikes: this.contarLikes
        }
    },
    /**Es un metodo cuando se ejecuta al inicio o cuando carga la página completamente*/
    mounted(){
        console.log(this.contarLikes);
    },
    /**Se utiliza este metedo para crear una peticion axios al servidor*/
    methods:{
        darLike(){
            //console.log('like a',this.recetaId);
            /**Se realiza la peticion al servidor */
            axios.post('/recetas/'+this.recetaId)
                /**El servidor responde con una respuesta*/
                .then(respuesta =>{
                    console.log(respuesta);
                    if(respuesta.data.attached.length > 0){
                        this.$data.totalLikes++;
                    }else{
                        this.$data.totalLikes--;
                    }
                })
                /**EL servidor responde con un error*/
                .catch(error =>{
                    if(error.response.status === 401){
                        window.location = '/login'
                    };
                })
        }
    },
    /**Son metodos que se utilizan para modicar el valor de las variables dinamicamente */
    computed:{
        cantidadLikes: function(){
            return this.totalLikes;
        }
    }
}
</script>
