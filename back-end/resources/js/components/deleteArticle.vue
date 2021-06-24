<template>
    <li class="list-group-item">
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
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">id=</span>
            <input v-model="id" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            <button @click="deleteArticle()" class="btn btn-info">Удалить</button>
        </div>
    </li>
</template>

<script>
    import Axios from 'axios';

    export default {
        name: "deleteArticle",
        data: function () {
            return {
                id: "",
                count: 0,
                article: {},
                errors_count: 0,
                errors: {},
                status: {},
                status_count: 0,
            }
        },
        methods: {
            deleteArticle() {

                this.status = {};
                this.errors = {};
                this.errors_count = 0;
                this.status_count = 0;

                Axios.delete('api/article/delete/' + this.id)
                    .then(response => {
                        this.status = response.data.status;
                        this.status_count = Object.keys(response.data).map((key) => [Number(key), response.data[key]]).length;

                        if ( !this.status ) {

                            this.errors = response.data.error;
                            this.errors_count = this.status_count;
                            this.status = {}
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