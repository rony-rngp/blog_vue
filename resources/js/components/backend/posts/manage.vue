<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Posts</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="float-left">Post List</h3>
                                <p class="float-right">
                                    <router-link class="btn btn-info btn-sm" to="/add-post"><i class="fa fa-plus-square"></i> Add Post</router-link>
                                </p>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>User</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(post, key) in getPosts">
                                        <td>{{ key+1 }}</td>
                                        <td>{{ post.title | subString(20) }}</td>
                                        <td>{{ post.category.name }}</td>
                                        <td>{{ post.user.name }}</td>
                                        <td>{{ post.description | subString(30)}}</td>
                                        <td><img :src="fileLink(post.image)" style="width:60px"></td>
                                        <td><span class="badge" :class="statusColor(post.status)">{{ statusName(post.status) }}</span></td>
                                        <td>
                                            <router-link :to="'/edit-post/'+post.id" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></router-link>
                                            <button type="button" @click="removePost(post.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    <tr v-if="emptyData()">
                                        <td colspan="8" class="text-center">
                                            <h5 class="text-danger">Data not found</h5>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    export default {
        name: "manage",
        computed : {
            getPosts(){
                return this.$store.getters.posts;
            }
        },
        methods : {
            statusName(status){
               let data = {
                   0: "Inactive",
                   1: "Active",
               };
               return data[status];
            },

            statusColor(status){
                let data = {
                    0 : "badge-danger",
                    1 : "badge-success"
                };
                return data[status];
            },

            fileLink(name){
                return 'backend/upload/posts/'+name;
            },

            removePost(id){
                let test = this;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get('destroy/post/'+id).then(function (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            test.$store.dispatch("getPosts");
                        }).catch(function (error) {
                            console.log(error)
                        });

                    }
                });
            },

            emptyData(){
                return this.getPosts.length < 1;
            }

        },
        mounted() {
            this.$store.dispatch('getPosts');
        }


    }

</script>

<style scoped>

</style>
