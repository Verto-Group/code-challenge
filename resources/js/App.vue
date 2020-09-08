<template>
    <body>
        <div class="card-body">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a href="/search" class="nav-item nav-link">Home</a>
                        <a href="/" class="nav-item nav-link">View Saved</a>
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