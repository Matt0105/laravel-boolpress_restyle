<template>
    <div class="sidebar">
        <div class="menu-container">
            <ul class="link-list">
                <li class="link-item" :class="$route.name == 'home' ? 'active' : ''">
                    <router-link :to="{name: 'home'}"><i class="fa-solid fa-house"></i><span class="link-label">Feed</span></router-link>
                </li>
                <li class="link-item" :class="$route.name == 'posts' ? 'active' : ''">
                    <router-link :to="{name: 'posts'}"><i class="fa-solid fa-envelopes-bulk"></i><span class="link-label">Posts</span></router-link>
                </li>
                <li class="link-item" :class="$route.name == 'about' ? 'active' : ''">
                    <router-link :to="{name: 'about'}"><i class="fa-solid fa-circle-info"></i><span class="link-label">About</span></router-link>
                </li>
                <li class="link-item" :class="$route.name == 'contacts' ? 'active' : ''">
                    <router-link :to="{name: 'contacts'}"><i class="fa-solid fa-address-card"></i><span class="link-label">Contacts</span></router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    data() {
        return {
            
        }
    }
}
</script>

<style lang="scss">
    .sidebar {
        display: flex;
        justify-content: center;
        height: calc(100vh - 70px);
        padding: 1rem 0;
        // width: 30%;
        width: 100%;
        background-color: #f8fbfc;

        .menu-container {
            width: 90%;

            .link-list {
                width: 100%;
                padding: 2rem 0;
                background-color: white;
                box-shadow: 2px 2px 10px rgba(150,150,150,0.2);
                border-radius: 8px;
                list-style: none;

                .link-item.active {
                    position: relative;
                    left: 10px;
                    border-left: 3px solid #1977f2;
                    box-shadow:  2px 2px 10px #1977f26e;
                    background-color: white;


                    border-radius: 10px;
                    a {
                        color: #1977f2;
                    }
                    i {
                        color: #1977f2;
                    }
                }

                .link-item {
                    width: calc(100%);
                    padding: 1rem 1rem;
                    // margin: 0 1rem;
                    border-bottom: 1px solid rgba(211, 211, 211, 0.349);
                    transition: all 0.2s;


                    // &:hover {
                    //     position: relative;
                    //     left: 10px;
                    //     border-left: 2px solid #1977f2;
                    //     box-shadow:  2px 2px 10px #1977f26e;
                    //     background-color: white;


                    //     border-radius: 10px;
                    //     a {
                    //         color: #1977f2;
                    //     }
                    //     i {
                    //         color: #1977f2;
                    //     }
                    // }

                    i {
                        font-size: 1.2rem;
                        color: rgb(212, 211, 211);
                    }

                    .link-label {
                        margin-left: 10px;
                    }

                    &:last-child {
                        border-bottom: none;
                    }

                    a {
                        color: rgb(58, 56, 56);
                    }
                }
            }
        }
    }
</style>