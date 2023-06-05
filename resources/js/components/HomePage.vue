<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-text-field v-model="search" label="Search" @input="searchPosts"></v-text-field>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="6" md="4" v-for="(post, index) in paginatedPosts" :key="index">
                <v-card>
                    <v-img :src="post.image" height="200px"></v-img>
                    <v-card-title>
                        <span v-html="highlightText(post.title)"></span>
                    </v-card-title>
                    <v-card-text>
                        <span v-html="highlightText(post.content)"></span>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn icon @click="likePost(index)">
                            <v-icon >mdi-heart</v-icon>
                        </v-btn>
                        <span>4</span>
                        <v-spacer></v-spacer>
                        <v-icon small class="mr-2" @click="openEditModal(post)" v-if="authenticated">mdi-pencil</v-icon>
                        <v-icon small @click="deletePost(post)" v-if="authenticated">mdi-delete</v-icon>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>

        <v-row justify="center">
            <v-pagination v-model="currentPage" :length="totalPages" @input="paginatePosts"></v-pagination>
        </v-row>

        <post-modal :post="selectedPost" ref="postModal" @save="savePost"></post-modal>

    </v-container>
</template>

<script>
import PostModal from "./PostModal.vue";
export default {
    components: {PostModal},
    data() {
        return {
            posts: [
                {
                    id:1,
                    title:"Post One",
                    description:"My post desc",
                    image:"https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                },
                {
                    id:2,
                    title:"Post Two",
                    description:"My post desc",
                    image:"https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                },
                {
                    id:1,
                    title:"Post One",
                    description:"My post desc",
                    image:"https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                },
                {
                    id:2,
                    title:"Post Two",
                    description:"My post desc",
                    image:"https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                },
                {
                    id:1,
                    title:"Post One",
                    description:"My post desc",
                    image:"https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                },
                {
                    id:2,
                    title:"Post Two",
                    description:"My post desc",
                    image:"https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                },
                {
                    id:1,
                    title:"Post One",
                    description:"My post desc",
                    image:"https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                },
                {
                    id:2,
                    title:"Post Two",
                    description:"My post desc",
                    image:"https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                }
            ],
            currentPage: 1,
            postsPerPage: 30,
            totalPosts: 0 ,
            search:"",
            selectedPost: {},
            editPostData: {
                id: null,
                title: '',
                content: '',
                image: null
            },
            authenticated:true
        };
    },
    created() {

    },
    watch: {

    },
    computed: {
        paginatedPosts() {
            return this.posts;
        },
        totalPages() {
            return Math.ceil(this.totalPosts / this.postsPerPage);
        }
    },
    methods: {
        fetchPosts() {

        },

        openEditModal(post) {
        },
        savePost(editedPost) {
        },
        deletePost(post){
        },
        likePost(index) {

        },
        searchPosts() {
            this.currentPage = 1;
        },
        highlightText(text) {
            if (!this.search || this.search==='') {
                return text;
            }
            const regex = new RegExp(this.search, 'gi');
            return text.replace(regex, match => `<span class="highlight">${match}</span>`);
        },

    }
};
</script>
