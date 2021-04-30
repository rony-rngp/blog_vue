export default {
    state: {
        category_data: [],
        post_data : [],
    },
    getters : {
        categories(state){
            return  state.category_data;
        },
        posts(state){
            return state.post_data;
        },
        getActiveTopcategories(state){
            return  state.category_data;
        }

    },
    actions: {
        getCategories(data){
            axios.get('categories').then(function (response) {
                data.commit("categories", response.data.categories);
            }).catch(function () {

            });
        },

        getActiveCategories(data){
            axios.get('active-categories').then(function (response) {
                data.commit("categories", response.data.categories);
            }).catch(function () {

            });
        },

        getPosts(data){
            axios.get('posts').then(function (response) {
                data.commit('posts', response.data.posts);
            }).catch(function (error) {
                console.log(error);
            });
        },

        getActiveTopcategories(data){
            axios.get('active-categories').then(function (response) {
                data.commit("categories", response.data.categories);
            }).catch(function () {

            });
        }, 

        get_posts(data){
            axios.get('all-posts').then(function (response) {
                data.commit("posts", response.data);
            }).catch(function () {

            });
        }
    },
    mutations: {
        categories(state, data){
            state.category_data = data;
        },

        posts(state, data){
            state.post_data = data;
        }

    }
}
