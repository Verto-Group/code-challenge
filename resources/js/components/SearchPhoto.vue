<template>
    <div class="card-body">
        <div class="card-body">
            <!-- <h3 class="text-center">Search Photo</h3> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-text">Kindly enter a keyword to browse unsplash images.</p>
                        <input class="form-control form-control-lg" type="search" placeholder="Search Photos" v-model="searchValue" aria-label="Search">
                        <button class="btn btn-primary" v-on:click = "fetchPictures">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div v-if="noResults" class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Sorry,</strong> we couldn't find any results matching "{{tempSearchValue}}"
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <!-- Display the page results -->
            
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
    </div>
</template>
 
<script>
    import expandableImage from './commonuse/expandableImage';
    import observer from './commonuse/observer';
    import searchCardBody from './commonuse/searchCardBody';

    export default {
        data() {
            return {
                searchValue:'',
                tempSearchValue:'',
                pictures:[],
                picture:{
                    id:'',
                    title:'',
                    picLink:'',
                    altInfo:'',
                },
                page:1,
                noSearch: true,
                noResults:false,
                nosearchClass: "input-group mt-5 mb-4 vertical-center",
                searchClass:"input-group mt-5 mb-4",
                intersect:'',
                isEditing: false,
            }
        },

        components: {
            observer,expandableImage,searchCardBody
        },

        methods: {

            test () {
                // var data = { text: this.text }

                fetch('api/test', {
                    method: 'GET', // *GET, POST, PUT, DELETE, etc.
                    headers: {
                    'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data) // body data type must match "Content-Type" header

                })
                    .then(r => r.json())
                    .then(r => {
                    // test
                    if (r.status === '200') {
                        console.log('correct token', r.status)
                    } else {
                        alert('Invalid Credentails. Kindly try again')
                        console.log('incorrect token ', "Sample data")
                    }
                    // console.log(r)
                })
                .catch(err => console.error(err))
            },

            fetchPictures() {
                let clientId = '8f2610cce8b7e60e887e6c6024cae7be704ffabd1aea6d7caa9dbefe4e70ab46';
                let searchValue = this.searchValue;
                this.page = 1;
                let url = `https://api.unsplash.com/search/photos?client_id=${clientId}&page=${this.page}&query=${searchValue}`;
                
                //make a request to upslah api
                fetch(url)
                    .then((data)=>{
                        return data.json();
                        console.log("Invalid request")
                    })
                    .then((data)=>{
                        let vm = this;
                        this.pictures = data.results;
                        let total_pages = data.total_pages;
                        if(total_pages === 0){
                            this.tempSearchValue = this.searchValue;
                            this.noResults=true;
                            return
                        }
                        this.noResults = false;
                        this.noSearch = false;
                    })
            },

            intersected() {
                let clientId = '8f2610cce8b7e60e887e6c6024cae7be704ffabd1aea6d7caa9dbefe4e70ab46';
                let searchValue = this.searchValue;

                //load more pictures from server
                ++this.page;
                let url = `https://api.unsplash.com/search/photos?client_id=${clientId}&page=${this.page}&query=${searchValue}`;

                fetch(url)
                    .then((data)=>{
                        return data.json();
                    })
                    .then((data)=>{
                        const new_photoes = data.results;
                        this.pictures = [...this.pictures,...new_photoes];
                    })
            },
            downloadBig(e) {
                if(e){
                    let temp = e.target.attributes; 
                    let myphoto_id = temp["data-id"].value;
                    let client_id = '8f2610cce8b7e60e887e6c6024cae7be704ffabd1aea6d7caa9dbefe4e70ab46';
                    let url = `https://api.unsplash.com/photos/${myphoto_id}/download?client_id=${client_id}`;
                    this.downloadWithVueResource(url,myphoto_id);
                }else{
                    return 
                }
            },
            forceFileDownload(url,myphoto_id){
                const link = document.createElement('a');
                link.href = url;
                link.style.display = "none";
                document.body.appendChild(link);
                link.setAttribute('target','_blank');
                link.setAttribute('download',  `${myphoto_id}.jpg`);

                //this function not allow to download directly but get new _blank
                //could be fixed in future
                link.click();

                window.URL.revokeObjectURL(link.href);
                document.body.removeChild(link);

            },
            downloadWithVueResource(url,myphoto_id) {
                fetch(url)
                    .then(data=>{
                        return data.json();
                    })
                    .then(response => {
                        this.forceFileDownload(response.url,myphoto_id)  
                    })
                    .catch(() => console.log('error occured'))
            },
            beforeRouteLeave(to, from, next) {
                if (this.isEditing) {
                    if (!window.confirm("Leave without saving?")) {
                        return;
                    }
                }
                next();
            }
        }
    }
</script>
