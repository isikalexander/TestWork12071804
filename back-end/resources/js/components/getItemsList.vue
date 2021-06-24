<template>
    <li class="list-group-item">
        <!--<li class="list-group-item">Список статей</li>-->
        <div v-for="(article, index) in articles" :key="index">
            <div class="card">
                <div class="card-header">
                    <h2>{{ article.title }}</h2>
                </div>
                <div class="card-body">
                    <h3>{{ article.content }}</h3>
                </div>
            </div>

        </div>
    </li>
</template>

<script>
    export default {
        name: "getItemsList",
        props: ['articles'],
        created () {
            console.log(this.articles);
        }
    }
</script>

<style scoped>

</style>