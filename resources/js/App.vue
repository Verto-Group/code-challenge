<template>
    <body>
        <div class="card-body">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link to="/" class="nav-item nav-link">Home</router-link>
                        <router-link to="/search" class="nav-item nav-link">Search Photo</router-link>
                        <router-link to="/saved" class="nav-item nav-link">View Saved</router-link>
                    </div>
                </div>
            </nav>
            <br/>
            
            <div class="card-body">
                <h5 class="card-title">Welcome to Unsplash Random Search Code Challenge.</h5>
                <a class="navbar-brand" href="#"  v-if="noSearch">
                    <img src="https://vertogroup.com.au/wp-content/uploads/sites/2/2019/10/verto_group_document_logo_transparent-300x214.png" width="300" height="214" alt="">
                </a>
            </div>

            <router-view></router-view>

        </div>
    </body>
</template>
 
<script>
    export default {
         data() {
            return {
                noSearch: true,
            }
        },
    }
</script>