<template>
    <div>
        <h2 class="m-2 mt-4" id="formulaire">Bars</h2>
    
        <div v-if="!showForm">
            <div class="btn btn-secondary m-2" @click="showForm = !showForm">Ajouter</div>
        </div>
        <div v-else>
            <div class="btn btn-secondary m-2" @click="showForm = !showForm">Annuler</div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPosts(pagination.prev_page_url)">Précedent</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} à {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]"  class="page-item"><a class="page-link" href="#" @click="fetchPosts(pagination.next_page_url)">Suivant</a></li>
            </ul>
        </nav>
    
        <div class="card m-4" v-if="showForm">
            <div v-if="edit">
                <div class="card-header">Vous modifiez le bar: <strong> {{ post.title }} </strong></div>
            </div>
            <div v-else>
                <div class="card-header">Ajouter un bar</div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input v-model="post.title" type="text" class="form-control" id="title" placeholder="Entrez le titre">
                </div>
    
                <div class="form-group">
                    <label for="body">Description</label>
                    <input v-model="post.body" type="text" class="form-control" id="body" placeholder="Description">
                </div>
    
                <div class="btn btn-info" @click="addPost">Enregistrer</div>
            </div>
        </div>
    
        <div class="card card-body" v-for="post in posts.data" v-bind:key="post.id">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style="width:100%" :src="'http://localhost/lsapp/public/storage/cover_images/'+post.image"/>
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3>{{ post.title }}</h3>
                    <p>{{ post.body }}</p>
                    <hr>
                    <small>bar crée le: {{ post.date }} </small>
                    <hr>
                    <a href="#formulaire" class="btn btn-warning" @click="updatePost(post)">Modifier</a>
                    <a class="btn btn-danger" @click="deletePost(post.id)">Effacer</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: [],
                post: {
                    id: '',
                    user_id: '1',
                    title: '',
                    body: '',
                    date: '',
                    image: ''
                },
                post_id: '',
                pagination: {},
                edit: false,
                showForm: false
            };
        },
    
        created() {
            this.fetchPosts();
        },
    
        methods: {
            fetchPosts() {
                let uri = "http://localhost:8000/api/posts";
                this.axios.get(uri)
                    .then(response => {
                        this.posts = response.data;
                        this.makePagination(this.posts);
                    });
            },
    
            addPost() {
                if (this.edit == false) {
                    let uri = "http://localhost:8000/api/posts";
                    this.axios.post(uri, this.post);
                    alert('Bar ajouté');
                    this.post = {
                        user_id: 1
                    };
                    this.fetchPosts();
                }
                //update the post
                else {
                    let uri = "http://localhost:8000/api/posts/" + this.post.id;
                    this.axios.put(uri, this.post)
                    .then(this.fetchPosts());
                    alert('Note Modifiée');
                    this.post = {
                        user_id: 1,
                    };
                    this.fetchPosts();
                    this.edit = false;
                }
            },
    
            updatePost(post) {
                //duplicate the object to avoid the instant update
                this.post = JSON.parse(JSON.stringify(post));
                this.edit = true;
                this.showForm = true;
            },
    
            deletePost(id) {
                if (confirm('Voulez-vous vraiment supprimer le bar?')) {
                    let uri = `http://localhost:8000/api/posts/`+id;
                    this.axios.delete(uri)
                    this.fetchPosts()
                }
            },
    
            makePagination(posts) {
                let pagination = {
                    current_page: posts.meta.current_page,
                    last_page: posts.meta.last_page,
                    next_page_url: posts.links.next,
                    prev_page_url: posts.links.prev
                };
                this.pagination = pagination;
            }
        }
    };
</script>