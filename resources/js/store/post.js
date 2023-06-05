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
};

const mutations = {
    setPosts: (state, posts) => {
        state.posts = posts;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
