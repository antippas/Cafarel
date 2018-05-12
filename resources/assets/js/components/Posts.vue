<template>
    <div>
        <h2>BARS</h2>
        <form @submit.prevent="addPost" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model="post.title">
            </div>
            <div class="form-group">
                <textarea type="text" class="form-control" placeholder="Body" v-model="post.body"></textarea>
            </div>
            <button type="submit" class="btn btn-light btn-block">Save</button>
        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPosts(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} à {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]"  class="page-item"><a class="page-link" href="#" @click="fetchPosts(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <div class="card card-body" v-for="post in posts" v-bind:key="post.id">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:100%" :src="'http://localhost/lsapp/public/storage/cover_images/'+post.image"/>
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3>{{ post.title }}</h3>
                    <p>{{ post.body }}</p>
                    <small>Créé le {{ post.created_at }}</small>
                    <hr>
                    <button @click="deletePost(post.id)" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                posts: [],
                post: {
                    id: '',
                    user_id: '',
                    title: '',
                    body: '',
                    created_at: "",
                    updated_at: "",
                    cover_image: ''
                },
                post_id: '',
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchPosts();
        },
        /*
        methods: {
            fetchPosts(page_url) {
                let vm = this;
                page_url = page_url || 'http://localhost:8000/api/posts';
                this.axios.get(page_url)
                .then(res => {
                    this.posts = res.data.data
                    vm.makePagination(res.meta, res.links);
                })
            },
            makePagination: function(data){
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url
                }
                this.$set('pagination', pagination)
            }
        }
        */
        methods: {
            fetchPosts(page_url) {
            let vm = this;
            page_url = page_url || 'http://localhost:8000/api/posts';
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                this.posts = res.data;
                vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },
            deletePost(id) {
                if (confirm('Êtes-vous sûr ?')) {
                    fetch(`http://localhost:8000/api/post/${id}`, {
                    method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Bar supprimé');
                        this.fetchPosts();
                    })
                    .catch(err => console.log(err));
                }
            },
            addPost() {
                if (this.edit === false) {
                // Add
                fetch('http://localhost:8000/api/posts', {
                method: 'post',
                body: JSON.stringify(this.post),
                headers: {
                    'content-type': 'application/json'
                }
                })
                .then(res => res.json())
                .then(data => {
                    //clear the form
                    this.post.title = '';
                    this.post.body = '';
                    alert('Bar Ajouté !');
                    this.fetchPosts();
                })
                .catch(err => console.log(err));
                } else {
                    // Update
                    fetch('api/http://localhost:8000/api/posts', {
                    method: 'put',
                    body: JSON.stringify(this.post),
                    headers: {
                        'content-type': 'application/json'
                    }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.post.title = '';
                        this.post.body = '';
                        alert('Bar mis à jour !');
                        this.fetchPosts();
                    })
                    .catch(err => console.log(err));
                }
            },
        }
        
    };
</script>