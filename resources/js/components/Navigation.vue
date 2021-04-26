<template>
    <nav class="px-5 navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" aria-current="page" exact :to="{ name: 'home' }">Home</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/about">About</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'pages.contact'}">Contact</router-link>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" :class="{ 'active' : isActive }" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        Notes
                    </a>
                    <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                        <li><router-link class="dropdown-item" :to="{name: 'notes.create'}">New Notes</router-link></li>
                        <li><router-link class="dropdown-item" :to="{name: 'notes.table'}">Table Of Notes</router-link></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        computed: {
            isActive() {
                return this.$route.path === '/notes/create' || this.$route.path === '/notes/table';
            }
        }
    }
</script>
