<template>
    <div class="container py-3">
        <div class="card my-5" v-for="(post, index) in posts" :key="index">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.article }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="#" class="btn btn-primary">Read</a>
                    <small>Published: {{ post.created_at }}</small>
                </div>
            </div>
        </div>
        <nav>
            <ul class="pagination">
                <li class="page-item" :class="{ active: pages.currentPage === n }" v-for="n in pages.lastPage" :key="n">
                    <a class="page-link" @click="getPosts(n)">{{ n }}</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data(){
            return {
                baseUri:'http://127.0.0.1:8000',
                posts: [],
                pages: {}
            }
        },
        methods: {
            getPosts(page) {
                axios.get(`${this.baseUri}/api/posts?page=${page}`)
                .then((res)=> {
                    const {data, current_page, last_page} = res.data;
                    this.posts = data;
                    this.pages = { currentPage: current_page, lastPage: last_page }
                })
                .catch((err)=> { console.error(err); });
            }
        }, 
        created(){
            this.getPosts();
        }
    }
</script>

<style scoped>
    .page-link {
        cursor: pointer;
    }
</style>
