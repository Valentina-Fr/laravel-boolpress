<template>
    <div>
        <div class="card my-5" v-for="(post, index) in postList" :key="index">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.article }}</p>
                <small>Published: {{ getFormattedDate(post.created_at) }}</small>
                <ul v-if="post.tags.length">Tags: </ul>
                <li v-for="(tag, index) in post.tags" :key="index">{{ tag.name }} </li>
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
            let minutes = postDate.getMinutes();

            if (day < 10) {
                day = '0' + day;
            }
            
            if(month < 10) {
                month = '0' + month;
            }

            if(minutes < 10) {
                minutes = '0' + minutes;
            }

            return `${day}/${month}/${year} ${hours}:${minutes}`
        }
    }
}
</script>

<style scoped>
    ul, li {
        display: inline-block;
        font-size: 80%;
        font-weight: 400;
    }

    li {
        padding-right: 5px;
    }
</style>