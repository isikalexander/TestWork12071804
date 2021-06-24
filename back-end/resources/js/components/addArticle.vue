<template>
    <li class="list-group-item">
        <div class="card">
            <div class="card-header">
                <div v-if="errors_count > 0">
                    <div v-for="(e, index) in errors" :key="index">
                        <p class="alert-danger">{{ e }}</p>
                    </div>
                </div>
                <div v-if="status_count > 0">
                    <div v-for="(s, index) in status" :key="index">
                        <p class="alert-success">{{ s }}</p>
                    </div>
                </div>
                <input v-model="article.title" placeholder="Название статьи" class="form-control">
            </div>
            <div class="card-body">
                <textarea v-model="article.content" class="form-control">Контент....</textarea>
            </div>
            <div class="card-footer">
                <button @click="addArticle()" class="btn btn-success">Добавить</button>
            </div>
        </div>
    </li>
</template>

<script>
    import Axios from 'axios';

    export default {
        name: "addArticle",
        data: function () {
            return {
                count: 0,
                article: {},
                errors_count: 0,
                errors: {},
                status: {},
                status_count: 0,
            }
        },
        methods: {
            addArticle() {

                this.status = {};
                this.errors = {};
                this.errors_count = 0;
                this.status_count = 0;

                let formData = new FormData();

                formData.append('title', this.article.title);

                if ( this.article.content == undefined ) {
                    this.article.content = "";
                }

                formData.append('content', this.article.content);
                formData.append('_method', 'POST');

                Axios.post('api/article/add', formData)
                    .then(response => {
                        this.status = response.data.status;
                        this.status_count = Object.keys(response.data).map((key) => [Number(key), response.data[key]]).length;

                        if ( !this.status ) {

                            this.errors = response.data;
                            this.errors_count = this.status_count;
                            this.status = {};
                            this.status_count = 0;


                        }
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
        }
    }
</script>

<style scoped>

</style>