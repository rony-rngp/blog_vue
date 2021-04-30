<template>

    <div>
        <div class="container">
            <div class="row">
                <div class="blog-page">
                    <div class="col-md-9">
                        <div v-for="post in getPosts" class="blog-post  wow fadeInUp">
                            <a href="blog-details.html"><img class="img-responsive" :src="fileLink(post.image)" alt=""></a>
                            <h1><router-link :to="'/post/'+post.slug">{{ post.title }}</router-link></h1>
                            <span class="author">{{ post.user.name }}</span>
                            <span class="review">6 Comments</span>
                            <span class="date-time">{{ post.created_at | time }}</span>
                            <div v-html="post.description"></div>
                            <router-link :to="'/post/'+post.slug" class="btn btn-upper btn-primary read-more">read more</router-link>
                        </div>

                        <div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

                            <div class="text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                        <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                        <li><a href="#">1</a></li>
                                        <li class="active"><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul><!-- /.list-inline -->
                                </div><!-- /.pagination-container -->    </div><!-- /.text-right -->

                        </div><!-- /.filters-container -->
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
        name: "home",
        components : {
            'sidebar' : sidebar,
        },
        mounted() {
            this.$store.dispatch("get_posts");
        },

        computed : {
            getPosts(){
                return this.$store.getters.posts;
            }
        },

        methods : {

            fileLink(name){
                return 'backend/upload/posts/'+name;
            }
        },
        
    }
</script>

<style scoped>

</style>
