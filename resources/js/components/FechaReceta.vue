<template>
    <span> {{formatearFecha}}</span>
</template>

<script>
export default {
    props:['fecha'],

    mounted(){
        console.log('Fecha publicación',this.fecha);
    },

    computed:{
        formatearFecha(){
            var date = new Date(this.fecha);
            const meses = ["Enero","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
            let formato_fecha = date.getDate()+"-"+meses[date.getMonth()]+"-"+date.getFullYear()
            return formato_fecha
        }
    }
}
</script>