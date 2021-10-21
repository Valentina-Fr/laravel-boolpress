<template>
    <div>
        <div class="card my-5" v-for="(post, index) in postList" :key="index">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.article }}</p>
                <small>Published: {{ getFormattedDate(post.created_at) }}</small>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ListCard',
    props: ['postList'],
    methods: {
        getFormattedDate(date) {
            const postDate = new Date(date);
            let day = postDate.getDate();
            let month = postDate.getMonth() + 1;
            let year = postDate.getFullYear();
            const hours = postDate.getHours();
            const minutes = postDate.getMinutes();

            if (day < 10) {
                day = '0' + day;
            }
            
            if(month < 10) {
                month = '0' + month;
            }

            return `${day}/${month}/${year} ${hours}:${minutes}`
        }
    }
}
</script>

<style scoped>
    
</style>