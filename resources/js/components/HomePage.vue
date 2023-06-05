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
                    <v-img :src="getImage(post.image)" height="200px"></v-img>
                    <v-card-title>
                        <span v-html="highlightText(post.title)"></span>
                    </v-card-title>
                    <v-card-text>
                        <span v-html="highlightText(post.content)"></span>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn icon @click="like(post)">
                            <v-icon :color="post.is_liked ? 'red' : 'grey'">mdi-heart</v-icon>
                        </v-btn>
                        <span v-if="post.total_likes">{{post.total_likes }}</span>
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
import { mapActions, mapGetters } from 'vuex';

export default {
    components: {PostModal},
    data() {
        return {
            posts: [],
            baseUrl:process.env.IMAGE_BASE_URL,
            currentPage: 1,
            postsPerPage: 6,
            totalPosts: 0 ,
            search:"",
            selectedPost: {},
            editPostData: {
                id: null,
                title: '',
                content: '',
                image: null
            },
            authenticated:this.$store.state.auth.authenticated
        };
    },
    created() {
        const params = {
            page: this.currentPage,
            limit: this.postsPerPage,
            search:this.search
        }
        this.fetchPosts(params);
    },
    watch: {
        allPosts(newPosts) {
            this.posts = newPosts.data.posts;
            this.totalPosts = newPosts.data.totalPosts;
        },
    },
    computed: {
        ...mapGetters(['allPosts']),
        paginatedPosts() {
            return this.posts;
        },
        totalPages() {
            return Math.ceil(this.totalPosts / this.postsPerPage);
        }
    },
    methods: {
        ...mapActions(['fetchPosts','savePostData','createPost','likePost','delete']),
        openEditModal(post) {
            this.selectedPost = post;
            this.$refs.postModal.dialog = true;
        },
        getImage(url){
            return window.baseIMAGE_URL + url;

        },

        savePost(editedPost) {
            this.savePostData(editedPost);
        },

        deletePost(post){
            console.log(post)
            this.delete(post);
        },

        like(post) {
            if(!this.authenticated){
                alert('login first');
                return
            }
            this.likePost(post);
        },
        searchPosts() {
            this.currentPage = 1;
            const params = {
                page: this.currentPage,
                limit: this.postsPerPage,
                search:this.search
            }
            this.fetchPosts(params);
        },

        highlightText(text) {
            if (!this.search || this.search==='') {
                return text;
            }
            const regex = new RegExp(this.search, 'gi');
            return text.replace(regex, match => `<span class="highlight">${match}</span>`);
        },

        paginatePosts(page) {
            const params = {
                page: this.currentPage,
                limit: this.postsPerPage,
                search:this.search
            }
            this.currentPage = page;
            this.fetchPosts(params);
        }

    }
};
</script>
