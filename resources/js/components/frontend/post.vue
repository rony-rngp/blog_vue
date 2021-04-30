<template>

    <div>
        <div class="container">
            <div class="row">
                <div class="blog-page">
                    <div class="col-md-9">

                         <div class="blog-post  wow fadeInUp">
                            <a href=""><img class="img-responsive" :src="fileLink(post.image)" alt=""></a>
                            <h1>{{ post.title }}</h1>
                            <span class="review">6 Comments</span>
                            <span class="date-time">{{ post.created_at | time }}</span>
                            <div v-html="post.description"></div>
                            
                        </div>


                    </div>


                    <div class="col-md-3 sidebar">


                        <sidebar></sidebar>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	
	import sidebar from "./sidebar";

    export default {
        name: "post",
        components : {
            'sidebar' : sidebar,
        },

        data(){
        	return {
        		post : {},
        	}
        },

        methods : {
        	posts(){
        		let test = this;
                axios.get('/single-post/'+this.$route.params.slug).then(function (response) {
                    test.post = response.data;
                }).catch(function () {

                });
            },

            fileLink(name){
                return 'backend/upload/posts/'+name;
            },
        },
        mounted() {
        	this.posts();
        }
    }
</script>

<style scoped>

</style>
