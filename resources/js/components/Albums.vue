<template>
    <div class="container">
        <h2>Albums</h2>
        <div v-for="(album,index3) in albums" class="img" :key="index3" >
            <div v-if = "album.data">
                <!--a  target="_blank" :href="album.id"-->
                <router-link :to="`/albums/${album.data.id}`">
                    <img v-if="album.data.cover_photo" :src="album.data.cover_photo" alt="No Cover" width="300" height="200">

                    <img v-else src="/images/default_pic.jpeg" alt="No Cover" width="300" height="200">
                    
                </router-link>
                <div class="desc">
                    <div>{{album.data.name}}</div>
                </div>
                <!--/a-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name : 'Albums',

        props: {
            albums: {
                required: true
            },
        },
 
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
div.img {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
}

div.img:hover {
    border: 1px solid #777;
}

div.img img {
    width: 100%;
    height: auto;
}

div.desc {
    padding: 15px;
    text-align: center;
}
.btn{
    width: 40%;
    height: 40%;
    font-size: 0.8em;
}
</style>