<template>
  <div>
      <Main :postInfo="postInfo" :pageTitle="`HomePage`"/>
  </div>
</template>

<script>

import Main from "../components/Main.vue";

export default {
    name: "Home",
    components: {
        Main,
    },
    data() {
        return {
            postInfo: {
                
                posts: [],
                users: [],
                categories: [],
                tags: [],
                nextPage: "",
                prevPage: ""
                
            }
            // posts: []
        }
    },
    created() {
        //faccio la chiamata all'api e popolo tutte le info, con anche user, category, tags e pagine prev e next
        axios.get("http://127.0.0.1:8000/api/posts/random")
            .then(res => {
                console.log(res);
                this.postInfo.posts = res.data.resultsPosts.data;
                this.postInfo.users = res.data.resultsUsers;
                this.postInfo.categories = res.data.resultsCategories;
                this.postInfo.tags = res.data.resultsTags;

                this.postInfo.nextPage = res.data.resultsPosts.next_page_url;
                this.postInfo.prevPage = res.data.resultsPosts.prev_page_url;
                // console.log(this.postInfo.posts);
            })
            .catch(err => {
                console.log(err);
            })
    }
}
</script>

<style>

</style>