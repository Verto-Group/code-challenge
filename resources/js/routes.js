import SavedPost from './components/SavedPost.vue';
import Search from './components/SearchPhoto.vue';
import EditPost from './components/EditPost.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: SavedPost
    },
    {
        name: 'search',
        path: '/search',
        component: Search
    },
    {
        name: 'saved',
        path: '/saved',
        component: SavedPost
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditPost
    }
];