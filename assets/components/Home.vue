<template>
   <div class="container">
        <div class="row">
            <div class="controls col-md-6">
                <label>Filter by Name</label>
                <input type="text" v-model="filters.name" @input="setFilter">
            </div>
            <div class="controls col-md-6">
                <label>Filter by Family</label>
                <input type="text" v-model="filters.family" @input="setFilter">
            </div>
        </div>
        <div class="row">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Favorite</th>
                        <th>Name</th>
                        <th>Family</th>
                        <th>Order</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="fruit in this.$store.getters.getFruits" :key="fruit.id">
                        <td>
                            <input v-if="fruit.is_favorite == true" checked
                                type="checkbox"
                                v-model="favorite"
                                :value="fruit.id"
                                @click="favoriteAction()"
                            >
                            <input v-else-if = "fruit.is_favorite == false"
                                type="checkbox"
                                v-model="favorite"
                                :value="fruit.id"
                                @click="favoriteAction()"
                            >
                        </td>
                        <td>{{fruit.name}}</td>
                        <td>{{fruit.family}}</td>
                        <td>{{fruit.f_order}}</td>
                    </tr>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Favorite</th>
                        <th>Name</th>
                        <th>Family</th>
                        <th>Order</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"
                        v-for="i in this.$store.getters.getPagination.pagesCount " :key="i"
                        
                    >
                        <a class="page-link" @click="setPage(i)">{{i}}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapMutations, mapState, mapGetters} from 'vuex'
    import Pagination from 'vue-pagination-2';
    import axios from "axios";

    export default {
        name: "home",
        components: {
            Pagination
        },
        data: function() {
            return {
                favorite: [],
                filters: {
                    name: null,
                    family: null,
                }
            }
        },

        created: function () {
            this.$store.dispatch('loadFruits')
            setTimeout(() => {
                this.favorite = this.$store.getters.getFavorite
            }, 1000)
            
        },
        methods: {
            ...mapActions('Fruits', [
            "loadFruits",
            ]),
            setPage: function(page) {
                this.$store.dispatch('setPage', page)
                this.$store.dispatch('loadFruits')
            },
            setFilter: function() {
                this.$store.dispatch('setFilter', this.filters)
            },
            favoriteAction: function() {
                setTimeout(() => {
                    console.log(this.favorite)
                    console.log(this.favorite[0])

                    if(this.favorite.length > 10) alert("More than 10 can't be favorite")

                    if(
                        this.favorite !== null &&
                        this.favorite[0] !== null &&
                        this.favorite.length <= 10
                    ) {
                        axios.post('/index.php/favorite', this.favorite)
                    }
                }, 1000)
                
            },
        },
        computed: {
            //...mapState('Fruits', ['fruits']),
            //...mapGetters('Fruits', ['fruits']),
        }
    }
</script>


