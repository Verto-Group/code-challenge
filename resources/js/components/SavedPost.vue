<template>
    <div>
        <!-- <h3 class="text-center">All Posts</h3><br/>
 
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.id }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.description }}</td>
                <td>{{ post.created_at }}</td>
                <td>{{ post.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table> -->
         <!-- search results display -->
    <div class="container">
        <div class="card-columns">
            <div class="card border-light" v-for="picture in pictures" :key="picture.id">
                <!-- picture hover css class -->
                <div class="box14">
                    <!-- each picture display with zoom function -->
                    <expandable-image
                        class="image card-img-top"
                        :src="picture.urls.regular"
                        alt="picture.description"
                    />
                    <div class="box-content">
                        <h3 class="title">{{searchValue}}: {{picture.id}}</h3>
                        <ul class="icon">
                            <li><a ><i class="far fa-heart"></i></a></li>
                            <li><a @click.self = "downloadBig" :data-id="picture.id"><i class="fas fa-download"></i></a></li>
                        </ul>
                    </div>
                </div>

                <!-- each picture infor component -->
                <search-cardBody :description = "picture.description" :title = "searchValue" :photoId = "picture.id" :photoUrl = "picture.urls.regular"/>

            </div>
        </div>
        <!-- lazy loading pictutes observer componet -->
        <observer v-on:intersect="intersected" />
    </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                posts: [],
                pictures:[],
                intersected:[],


            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/posts')
                .then(response => {
                    this.posts = response.data;
                });
        },
        methods: {
            deletePost(id) {
                this.axios
                    .delete(`http://localhost:8000/api/post/delete/${id}`)
                    .then(response => {
                        let i = this.posts.map(item => item.id).indexOf(id); // find index of your object
                        this.posts.splice(i, 1)
                    });
            }
        }
    }
</script>