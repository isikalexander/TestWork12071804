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
        <div v-if="count>0">
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
                    <input v-model="article.title" class="form-control">
                </div>
                <div class="card-body">
                    <textarea v-model="article.content" class="form-control"></textarea>
                </div>
                <div class="card-footer">
                    <button @click="editArticle()" class="btn btn-success">Изменить</button>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    import Axios from 'axios';

    export default {
        name: "getArticleEdit",
        data: function () {
            return {
                id: "",
                article: {},
                count: 0,
                title: "",
                content: "",
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
            editArticle () {

                this.status = {};
                this.errors = {};
                this.errors_count = 0;
                this.status_count = 0;

                let formData = new FormData();

                formData.append('title', this.article.title);
                formData.append('content', this.article.content);
                formData.append('_method', 'PUT');

                Axios.post('api/article/edit/' + this.id, formData)
                    .then( response => {
                        this.status = response.data.status;
                        this.status_count = Object.keys(response.data).map((key) => [Number(key), response.data[key]]).length;

                        if ( !this.status ) {

                            this.errors = response.data;
                            this.errors_count = this.status_count;
                            this.status = {}
                            this.status_count = 0;


                        }

                    })
                    .catch( error => {
                        this.errors = error;
                        this.errors_count = Object.keys(error.response).map((key) => [Number(key), error.response[key]]).length;

                        console.log(this.errors);
                    });

            }
        }
    }
</script>

<style scoped>

</style>