<template>
  <nav>
      
    <div class="logo-container">
        <img class="logo-img" :src="logo" alt="">
    </div>
    <ul class="link-list">
        <li v-for="link in linkList" :key="link.id"><router-link :to="{name: link.routeLink}"><span class="link-label">{{link.label}}</span></router-link></li>
    </ul>
    <div class="searchbar">
        <input class="searchbar-input" type="text" placeholder="Search">
        <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
      
  </nav>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            logo: require("../../img/BoolPress.png"),
            linkList: [
                {
                    id: 1,
                    label: "Home",
                    routeLink: "home"
                },
                {
                    id: 2,
                    label: "Posts",
                    routeLink: "posts"
                },
                {
                    id: 3,
                    label: "About",
                    routeLink: "about"
                },
                {
                    id: 4,
                    label: "Contacts",
                    routeLink: "contacts"
                },
            ]
        }
    }
}
</script>

<style lang="scss" scoped>

    nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 70px;
        padding: 0 2rem;
        background-color: var(--salmon);

        .logo-img {
            height: 60px;
        }

        .link-list {
            display: flex;
            height: 100%;
            list-style-type: none;
            margin: 0 auto;

            li {
                display: flex;
                align-items: center;
                height: 100%;

                .link-label {
                    padding: 1.5rem 0.7rem;
                    font-size: 1.2rem;
                    transition: all 0.2s;
                }

                &:hover .link-label{
                    background-color: white;
                    color: var(--salmon);
                    padding: 0.3rem 0.7rem;
                }

                a {
                    color: white;
                    text-decoration: none;
                }
            }
        }

        .searchbar {
            display: flex;
            align-items: center;
            height: 100%;

            .searchbar-input {
                height: 50%;
                border-radius: 10px;
                padding: 0.5rem;
                outline: none;
                border: 3px solid rgb(240, 72, 72);
                background-color: #f3f6fa;
            }

            .search-btn {
                border: none;
                border-radius: 10px;
                height: 50%;
                width: 45px;
                margin-left: 5px;
                background-color: white;

                i {
                    color: var(--dark-gray);
                }
            }
        }
        
    }

</style>