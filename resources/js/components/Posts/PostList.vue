<template>
    <div class="container py-5">
        <div class="vh-100 d-flex justify-content-center align-items-center" v-if="isLoading">
            <div class="spinner-border"></div>
        </div>
        <Pagination :pagination='pages' @goToPage='getPosts'/>
        <ListCard :post-list='posts' />
        <Pagination :pagination='pages' @goToPage='getPosts'/>
    </div>
</template>

<script>
import ListCard from './ListCard.vue'
import Pagination from './Pagination.vue';
export default {
    name: 'PostList',
    components: {
        ListCard,
        Pagination
    },
    data(){
         return {
            baseUri:'http://127.0.0.1:8000',
            posts: [],
            pages: {},
            isLoading: false
        }
    },
    methods: {
        getPosts(page) {
            this.isLoading = true;
            axios.get(`${this.baseUri}/api/posts?page=${page}`)
            .then((res)=> {
                const {data, current_page, last_page} = res.data;
                this.posts = data;
                this.pages = { currentPage: current_page, lastPage: last_page }
            })
            .catch((err)=> { console.error(err); })
            .then(()=> { this.isLoading = false });
        }
    }, 
    created(){
        this.getPosts();
    }
}
</script>

<style scoped>
   
</style>