<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center ">
                        Test for Abelohost
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li  class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h1>Список статей</h1>
                                    </div>
                                    <div>
                                        <button v-if="isGetItemsList" class="btn btn-dark" @click="hideItemsList()">Назад</button>
                                        <button v-if="!isGetItemsList" class="btn btn-success" @click="getItemsList()">Показать</button>
                                    </div>
                                </div>
                            </li>
                            <get-items-list :articles="articles" v-if="isGetItemsList"></get-items-list>

                            <li  class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h1>Добавить статью</h1>
                                    </div>
                                    <div>
                                        <button v-if="isAddArticle" class="btn btn-dark" @click="hideAddArticle()">Назад</button>
                                        <button v-if="!isAddArticle" class="btn btn-success" @click="addArticle()">Показать</button>
                                    </div>
                                </div>
                            </li>
                            <add-article v-if="isAddArticle">

                            </add-article>
                            <li  class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h1>Найти статью</h1>
                                    </div>
                                    <div>
                                        <button v-if="isGetArticle" class="btn btn-dark" @click="hideArticle()">Назад</button>
                                        <button v-if="!isGetArticle" class="btn btn-success" @click="getArticle()">Открыть</button>
                                    </div>
                                </div>
                            </li>
                             <get-article v-if="isGetArticle"></get-article>
                            <li  class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h1>Редактировать статью</h1>
                                    </div>
                                    <div>
                                        <button v-if="isGetArticleEdit" class="btn btn-dark" @click="hideArticleEdit()">Назад</button>
                                        <button v-if="!isGetArticleEdit" class="btn btn-success" @click="getArticleEdit()">Открыть</button>
                                    </div>
                                </div>
                            </li>
                            <get-article-edit v-if="isGetArticleEdit"></get-article-edit>
                            <li  class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h1>Удалить статью</h1>
                                    </div>
                                    <div>
                                        <button v-if="isDeleteArticle" class="btn btn-dark" @click="hideDeleteArticle()">Назад</button>
                                        <button v-if="!isDeleteArticle" class="btn btn-success" @click="deleteArticle()">Открыть</button>
                                    </div>
                                </div>
                            </li>
                            <delete-article v-if="isDeleteArticle"></delete-article>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from 'axios';
    import getItemsList from './getItemsList';
    import getArticle from './getArticle';
    import getArticleEdit from './getArticleEdit';
    import deleteArticle from './deleteArticle';
    import addArticle from './addArticle';

    export default {
        mounted() {

        },
        components: {
            getItemsList,
            getArticle,
            getArticleEdit,
            deleteArticle,
            addArticle
        },
        data: function () {
            return {
                isGetItemsList: false,
                isGetArticle: false,
                isGetArticleEdit: false,
                isDeleteArticle: false,
                isAddArticle: false,
                articles: [],
                id: "",
            }
        },
        methods: {
            getItemsList() {

                this.isGetItemsList = true
            },
            hideItemsList() {

                this.isGetItemsList = false;

            },
            getArticles () {
                Axios.get('api/article/all')
                    .then( response => {
                        this.articles = response.data;
                    })
                    .catch (error => {
                        alert(error.response.data);
                    });
            },
            getArticle() {
                this.isGetArticle = true;
            },
            hideArticle(){
                this.isGetArticle = false;
            },
            getArticleEdit() {
                this.isGetArticleEdit = true;
            },
            hideArticleEdit() {
                this.isGetArticleEdit = false;
            },
            deleteArticle() {
                this.isDeleteArticle = true;
            },
            hideDeleteArticle() {
                this.isDeleteArticle = false;
            },
            addArticle() {
                this.isAddArticle = true;
            },
            hideAddArticle() {
                this.isAddArticle = false;
            }
        },
        created () {
            this.getArticles();
        }
    }
</script>
