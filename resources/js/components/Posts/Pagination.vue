<template>
    <nav>
        <ul class="pagination">
            <li class="page-item" :class="{disabled: pagination.currentPage === 1}">
                <a class="page-link" @click="$emit('goToPage', pagination.currentPage - 1)">Previous</a>
            </li>
            <li class="page-item" :class="{active: pagination.currentPage === n}" v-for="n in pagination.lastPage" :key="n">
                <a class="page-link" @click="$emit('goToPage', n)">{{ n }}</a>
            </li>
            <li class="page-item" :class="{disabled: pagination.currentPage === pagination.lastPage}">
                <a class="page-link" @click="$emit('goToPage', pagination.currentPage + 1)">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'Pagination',
    props: ['pagination']
}
</script>

<style scoped>
    .page-link {
        cursor: pointer;
    }
</style>