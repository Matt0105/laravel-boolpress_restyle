<template>
  <div>
      <div class="filter-window">

        <div class="filter-container">
            <i class="fa-solid fa-filter filter-icon"></i>
            <form action="">
                <div class="order">
                    <select name="orderCol" id="orderCol" v-model="search.orderCol">
                        <option value="title">Title</option>
                        <option value="category_id">Category</option>
                        <option value="created_at">Creation</option>
                        <option value="updated_at">Update</option>
                    </select>
                    
                    <select name="orderVs" id="orderVs" v-model="search.orderVs">
                        <option value="desc">Desc</option>
                        <option value="asc">Asc</option>
                    </select>
                </div>

                <div class="check-container-box">

                    <div class="check-container" v-for="(tag, index) in postInfo.tags" :key="tag.name + index">
                        <input type="checkbox" name="tags[]" :value="tag.name" v-model="search.tags">
                        <label :for="tag.name">{{tag.name}}</label>
                    </div>
                </div>

                <input class="btn btn-success" type="submit" @click.prevent="searchPosts()" value="Filter">
            </form>
        </div>
      </div>
      <Main :postInfo="postInfo" :pageTitle="`All Posts`"/>
  </div>
</template>

<script>

import Main from "../components/Main.vue";

export default {
    name: "Posts",
    components: {
        Main,
    },
    data() {
        return {
            
            search: {
                orderVs: "asc",
                orderCol: "updated_at",
                tags: [],
            },
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
        axios.get("http://127.0.0.1:8000/api/posts/allPosts")
            .then(res => {
                console.log(res);
                this.postInfo.posts = res.data.resultsPosts.data;
                this.postInfo.users = res.data.resultsUsers;
                this.postInfo.categories = res.data.resultsCategories;
                this.postInfo.tags = res.data.resultsTags;

                this.postInfo.nextPage = res.data.resultsPosts.next_page_url;
                this.postInfo.prevPage = res.data.resultsPosts.prev_page_url;
                console.log(this.postInfo.posts);
            })
            .catch(err => {
                console.log(err);
            })
    },
    methods: {
        searchPosts() {
            axios.get("http://127.0.0.1:8000/api/posts/search", {params: this.search})
            .then(res => {
                console.log(res);
                this.postInfo.posts = res.data.resultsPosts.data;
                this.postInfo.users = res.data.resultsUsers;
                this.postInfo.categories = res.data.resultsCategories;
                this.postInfo.tags = res.data.resultsTags;

                this.postInfo.nextPage = res.data.resultsPosts.next_page_url;
                this.postInfo.prevPage = res.data.resultsPosts.prev_page_url;
                console.log(this.postInfo.posts);
            })
            .catch(err => {
                console.log(err);
            })
        }
    }
}
</script>

<style lang="scss" scoped>

    .total-container {
        display: flex;
        overflow: scroll;
        padding: 1rem 0;
        height: calc(100vh - 70px - 180px);
        background-color: #f8fbfc;
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */

        &::-webkit-scrollbar {
            display: none;
        }
    }

    .filter-window {
        width: 100%;
        height: 180px;
        padding: 1rem;
        background-color: #f8fbfc;

        .filter-container {
            position: relative;
            width: 100%;
            padding: 1rem;
            border-radius: 15px;
            box-shadow: 2px 2px 10px #1977f233;
            background-color: white;

            .filter-icon {
                position: absolute;
                top: 1rem;
                right: 1rem;
                color: rgb(212, 211, 211);
            }

            form {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;

                select {
                    padding: 0.4rem;
                    border: 1px solid #1977f2;
                    border-radius: 5px;
                    margin-right: 5px;
                }

                .check-container-box {
                    display: flex;
                    flex-wrap: wrap;
                    width: 100%;

                    .check-container {
                        margin-right: 1rem;
                    }
                }

                .btn {
                    background-color: #1977f2;
                    color: white;
                    border: none;
                    padding: 0.5rem 1rem;
                    border-radius: 5px;
                    cursor: pointer;
                }
            }
        }
    }

</style>