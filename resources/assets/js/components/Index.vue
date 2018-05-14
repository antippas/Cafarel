<template>
    <div>
        <div class="container">
            <div class="jumbotron text-center">
                <h1>SHARE A BAR</h1>
                <p>Bienvenue sur l'application "SHARE A BAR" qui reprend vos bar favori.</p>
                <div class="album py-5 bg-light">
                    <div class="container">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPosts(pagination.prev_page_url)">Précedent</a></li>
                                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} à {{ pagination.last_page }}</a></li>
                                <li v-bind:class="[{disabled: !pagination.next_page_url}]"  class="page-item"><a class="page-link" href="#" @click="fetchPosts(pagination.next_page_url)">Suivant</a></li>
                            </ul>
                        </nav>
                        <div class="row">
                            <div class="col-md-4" v-for="post in posts" v-bind:key="post.id">
                                <div class="card-text">
                                    <h3>{{ post.title }}</h3>
                                </div>
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" style="height: 225px; width: 100%; display: block;" alt="Thumbnail [100%x225]" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" :src="'http://localhost/lsapp/public/storage/cover_images/'+post.image"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p></p>
                <p>Pour vous voir l'ensemble des bars présent sur l'application, cliquez sur "BAR"</p>
                <p>Pour vous inscrire et partager vos Bar cliquez sur "Développement"</p>
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
                    user_id: '1',
                    title: '',
                    body: '',
                    date: '',
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
        }
    };
</script>