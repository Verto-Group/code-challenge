<template>
    <div> 
        <!-- search results display -->
        <div class="container">
            <div class="card-columns">
                <div class="card border-light" v-for="picture in pictures" :key="picture.id">
                    <!-- picture hover css class -->
                    <div class="box14">
                        <!-- each picture display with zoom function -->
                        <expandable-image
                            class="image card-img-top"
                            :src="picture.download_url"
                            alt="picture.image_description"
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
                    <search-cardBody :description = "picture.image_description" :title = "searchValue" :photoId = "picture.id" :photoUrl = "picture.download_url"/>

                </div>
            </div>
            <!-- lazy loading pictutes observer componet -->
            <observer v-on:intersect="intersected" />
        </div>
    </div>
</template>
 
<script>
    import observer from './commonuse/observer';
    import searchCardBody from './commonuse/searchCardBody';
    import expandableImage from './commonuse/expandableImage';

    export default {
        data() {
            return {
                posts: [],
                pictures:[],
                intersected:[],
            }
        },
        components: {
            observer,expandableImage,searchCardBody
        },
        created() {
            this.axios
                .get('api/photo/saved')
                .then(response => {
                    this.pictures = response.data;
                });
        },
        methods: {
            deletePictureById(deletePictureId){
                if(confirm("Are you sure you want to delete this picture from library?")){
                    this.deleteData = {
                                picture_id: deletePictureId
                        };
                        fetch('api/delete',{
                                method:'delete',
                                body:JSON.stringify(this.deleteData),
                                headers: {
                                    'content-type':'application/json'
                                }
                        })
                        .then(()=>{
                            this.pageLoad = true;
                            this.deleteData.picture_id = '';
                            location.reload();
                        })
                }
            },
            downloadBig(e) {
                if(e){
                    let temp = e.target.attributes; 
                    let myphoto_id = temp["data-id"].value;
                    let client_id = '8f2610cce8b7e60e887e6c6024cae7be704ffabd1aea6d7caa9dbefe4e70ab46';
                    let url = `https://api.unsplash.com/photos/${myphoto_id}/download?client_id=${client_id}`;
                    this.downloadWithVueResource(url,myphoto_id);
                    // console.log(url);
                }else{
                    alert('Not found!')
                    return 
                }
            },
            forceFileDownload(url,myphoto_id){
                const link = document.createElement('a');
                link.href = url;
                link.style.display = "none";
                document.body.appendChild(link);
                link.setAttribute('target','_blank');
                link.setAttribute('download',  `${myphoto_id}.jpg`) //or any other extension

                link.click();

                window.URL.revokeObjectURL(link.href);
                document.body.removeChild(link);

                //to be fixed, child node can't be remove by click but after refresh
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
                
        }
        
    }
</script>