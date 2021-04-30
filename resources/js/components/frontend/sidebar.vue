<template>

    <div>
        <div class="sidebar-module-container">
            <div class="search-area outer-bottom-small">
                <form>
                    <div class="control-group">
                        <input placeholder="Type to search" class="search-field">
                        <a href="#" class="search-button"></a>
                    </div>
                </form>
            </div>

            <div class="home-banner outer-top-n outer-bottom-xs">
                <img src="frontend/images/banners/LHS-banner.jpg" alt="Image">
            </div>
            <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                <h3 class="section-title">Category</h3>
                <div class="sidebar-widget-body m-t-10">
                    <div class="accordion">

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#">
                                    Camera
                                </a>
                            </div><!-- /.accordion-heading -->
                        </div><!-- /.accordion-group -->

                    </div><!-- /.accordion -->
                </div><!-- /.sidebar-widget-body -->
            </div><!-- /.sidebar-widget -->
        </div>
    </div>
</template>

<script>
    export default {
        name: "sidebar"
       
    }
</script>

<style scoped>

</style>
