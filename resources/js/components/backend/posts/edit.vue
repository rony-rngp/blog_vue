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
                                <h3 class="float-left">Edit Post</h3>
                                <p class="float-right">
                                    <router-link class="btn btn-info btn-sm" to="/posts"><i class="fa fa-plus-square"></i> Post List</router-link>
                                </p>
                            </div>

                            <div class="card-body">
                                <form @submit.prevent="updatePost()" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="category_id">Category</label>
                                            <select class="form-control" id="category_id" v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }">
                                                <option value="">Select Category</option>
                                                <option v-for="category in getCategories" :value="category.id">{{ category.name }}</option>
                                            </select>
                                            <has-error :form="form" field="category_id"></has-error>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="title">Title</label>
                                            <input type="text" id="title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" v-model="form.title" placeholder="Enter Title">
                                            <has-error :form="form" field="title"></has-error>

                                        </div>

                                        <div class="form-group col-md-12">
                                            <label >Description</label>
                                            <ckeditor :editor="editor" v-model="form.description" :config="editorConfig" :class="{ 'is-invalid': form.errors.has('description') }"></ckeditor>
                                            <has-error :form="form" field="description"></has-error>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="image">Image</label>
                                            <input type="file" id="image" name="image" class="form-control" :class="{ 'is-invalid': form.errors.has('image') }" @change="loadImage($event)">
                                            <has-error :form="form" field="image"></has-error>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <img style="float: right; margin-top: 24px" :src="fileLink(form.image)" width="60px">
                                        </div>

                                        <div class="form-group col-md-7">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" v-model="form.status" value="1">Active
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" v-model="form.status" value="0">Inactive
                                                </label>
                                            </div>
                                            <span :class="{ 'is-invalid': form.errors.has('status') }"></span>
                                            <has-error :form="form" field="status"></has-error>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <button :disabled="form.busy" type="submit" class="btn btn-primary">Update</button>
                                        </div>

                                    </div>
                                </form>
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
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

    export default {
        name: "edit",
        data(){
            return {
                form : new Form({
                    'category_id' : '',
                    'title' : '',
                    'description' : '',
                    'image' : '',
                    'status' : ''
                }),

                editor: ClassicEditor,
                editorConfig: {

                }
            }
        },
        methods : {
            getPost(){
                let this_ = this;
                axios.get('/edit-post/'+this.$route.params.id).then(function (response) {
                    this_.form.fill(response.data.post);
                }).catch(function () {

                });
            },


            fileLink(name){
                if (name != '' && name.length < 256){
                    return 'backend/upload/posts/'+name;
                }else{
                    return this.form.image;
                }

            },

            updatePost(){
                let test = this;
                this.form.post('/update-post/'+this.$route.params.id).then(function (response) {
                    console.log(response.data);
                    Toast.fire({
                        icon: 'success',
                        title: 'Post Successfully Added'
                    });
                    test.$router.push('/posts');
                }).catch(function () {

                });
            },
            loadImage(e){
                let test = this;
                let file = e.target.files[0];
                let fileReader = new FileReader();
                fileReader.onload = function (e) {
                    test.form.image = e.target.result;
                };
                fileReader.readAsDataURL(file);
            }
        },

        mounted() {
            this.$store.dispatch("getActiveCategories");
            this.getPost();
        },

        computed : {
            getCategories(){
                return this.$store.getters.categories;
            },
        },

    }
</script>

<style scoped>

</style>
