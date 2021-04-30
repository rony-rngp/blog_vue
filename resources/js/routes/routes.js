
import dashboard from "../components/backend/dashboard";
//------Categories---------
import categories from "../components/backend/category/manage";
import add_category from "../components/backend/category/create";
import edit_category from "../components/backend/category/edit";
//--------Posts--------
import posts from "../components/backend/posts/manage";
import add_post from "../components/backend/posts/create";
import edit_post from "../components/backend/posts/edit";

//----------Frontend Components---------------
import About from "../components/frontend/About";
import home from "../components/frontend/home";
import category_post from "../components/frontend/category";
import single_post from "../components/frontend/post";



export const routes = [
    { path: '/home', component: dashboard},
    //------Categories-------
    { path: '/categories', component: categories},
    { path: '/add-category', component: add_category},
    { path: '/edit-category/:id', component: edit_category},
    ///--------Posts-------
    { path: '/posts', component: posts },
    { path: '/add-post', component: add_post },
    { path: '/edit-post/:id', component: edit_post },

    //----------Frontend Routes---------------
    { path : '/', component:  home},
    { path : '/about', component: About },
    { path : '/category/:slug', component: category_post },
    { path : '/post/:slug', component: single_post },
];
