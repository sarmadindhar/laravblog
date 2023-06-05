import axios from 'axios';
const state = {
    posts: {
        data:[],
        totalPosts:0
    },
};

const getters = {
    allPosts: state => state.posts,
};

const actions = {
    async fetchPosts({ commit },params) {
        try {
            const response = await axios.get('/api/post',{params});
            commit('setPosts', response);
        } catch (error) {
            console.error('Error fetching posts:', error);
        }
    },

    async savePostData({ commit },postData) {
        try {
            const formData = new FormData();
            formData.append('image', postData.image);
            formData.append('title', postData.title);
            formData.append('content', postData.content);
            formData.append('id', postData.id);
            formData.append('_method', 'PUT');
            const response = await axios.post(`/api/post/${postData.id}`,formData);
            commit('updatePost', response.data.data);
        } catch (error) {
            console.error('Error fetching posts:', error);
        }
    },

    async createPost({ commit },postData) {
        try {
            const formData = new FormData();
            formData.append('image', postData.image);
            formData.append('title', postData.title);
            formData.append('content', postData.content);
            const response = await axios.post(`/api/post`,formData);
            commit('createPost', response.data.data);
        } catch (error) {
            console.error('Error fetching posts:', error);
        }
    },
};

const mutations = {
    setPosts: (state, posts) => {
        state.posts = posts;
    },

    updatePost:(state,updatedPost)=>{
        const index = state.posts.data.posts.findIndex(post => post.id === updatedPost.id);
        if (index !== -1) {
            state.posts.data.posts.splice(index, 1, updatedPost);
        }
    },

    createPost:(state,newPost)=>{
        state.posts.data.posts.unshift(newPost);
    }


};

export default {
    state,
    getters,
    actions,
    mutations,
};
