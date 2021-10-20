<template>
    <div class="container mb-5">
        <div class="card my-5" v-for="(post, index) in posts" :key="index">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.article }}</p>
                <a href="#" class="btn btn-primary">Read</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data(){
            return {
                baseUri:'http://127.0.0.1:8000',
                posts: []
            }
        },
        methods: {
            getPosts() {
                axios.get(`${this.baseUri}/api/posts`)
                .then((res)=> { this.posts = res.data; })
                .catch((err)=> { console.error(err); });
            }
        }, 
        created(){
            this.getPosts();
        }
    }
</script>
