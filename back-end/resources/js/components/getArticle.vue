<template>
    <li class="list-group-item">
        <div v-if="errors_count > 0">
            <div v-for="(e, index) in errors" :key="index">
                <p class="alert-danger">{{ e }}</p>
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">id=</span>
            <input v-model="id" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            <button @click="findArticle()" class="btn btn-info">Найти</button>
        </div>
        <div v-if="count > 0">
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
    import Axios from 'axios';

    export default {
        name: "getArticle",
        data: function () {
            return {
                id: "",
                article: [],
                count: 0,
                errors_count: 0,
                errors: {},
                status: {},
                status_count: 0,
            }
        },
        methods: {
            findArticle() {


                this.status = {};
                this.errors = {};
                this.errors_count = 0;
                this.status_count = 0;

                Axios.get('api/article/'+this.id)
                    .then( response => {


                        if ( response.data.error ) {

                            this.errors = response.data.error;
                            this.errors_count = 1;

                        }

                        this.article = response.data;
                        count = 1;
                    })
                    .catch (error => {
                        console.log(error.response.data);
                    });
            },
        }

    }
</script>

<style scoped>

</style>