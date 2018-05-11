<template>
    <div>
        <h2>BARS</h2>
        <div class="card card-body" v-for="post in posts" v-bind:key="post.id">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img :src="'http://localhost/lsapp/public/storage/cover_images/'+post.image"/>
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3>{{ post.title }}</h3>
                    <p>{{ post.body }}</p>
                    <small>Créé le {{ post.date.filters }}</small>
                </div>
            </div>
        </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                posts: [],
                post: {
                    id: '',
                    title: '',
                    body: '',
                    date:'',
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
                page_url = page_url || 'http://localhost:8000/api/posts'
                this.axios.get(page_url)
                    .then(res => {
                        this.posts = res.data.data;
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));
                /*
                fetch('http://localhost:8000/api/posts')
                    .then(res => res.json())
                    .then(res=> {
                        this.posts = res.data;
                    });*/
            },
            makePagination(meta, links){
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            }
        }
    };
</script>