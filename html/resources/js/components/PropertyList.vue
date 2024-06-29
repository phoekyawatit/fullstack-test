<template>
    <div v-if="province && fitlerProperties.length == 0" class="text-center m-5">
        <h2> 404 Not Found</h2>
        <button class="btn btn-primary" @click="goHome">Go to home page</button>
    </div>
    <template v-else>
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-md-5">
                <label>Search</label>
                <input class="form-control" type="text" id="search" placeholder="Name,Province,.." v-model="search"/>
            </div>
            <div class="col-md-4">
                <label for="sorting">Sort By</label>
                <select class="form-control" id="province" v-model="sorting">
                    <option>-</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                    <option value="date-asc">Date: Newest First</option>
                    <option value="date-desc">Date: Oldest First</option>
                </select>
            </div>
        </div>
        <div class="row" v-if="fitlerProperties.length">
            <div class="col-md-3 mb-3" v-for="(property, index) in displayProperties">
                <img :src="property.photos.full" class="img-fluid" alt="FazFazWaz Property">
                <h2>{{property.title}}</h2>
                <div class="mb-2">{{property.description}}</div>
                <p>{{property.currency}} {{property.currency_symbol}} {{property.price}}</p>
                <p>Type: {{property.property_type}}</p>
                <p>Bathroom: {{property.bathrooms}} , Bedroom: {{property.bedrooms}}</p>
                <p>Area: {{property.area}} {{property.area_type}}</p>
            </div>
        </div>
        <div class="text-end" v-if="fitlerProperties.length">
            <vue-awesome-paginate
                  :total-items="fitlerProperties.length"
                  :items-per-page="perPage"
                  :max-pages-shown="perPage"
                  v-model="currentPage"
            />
        </div>
        <div class="row" v-if="fitlerProperties.length == 0">
            <div class="col-md-12"><h3 class="text-danger">No Result Found</h3></div>
        </div>
    </div>
</template>
</template>
<script>
import properties from '../properties.json';
export default {
    name: 'PropertyList',
    data() {
        return {
            properties: properties,
            fitlerProperties: properties,
            currentPage: 1,
            perPage: 25,
            sorting: null,
            search: null,
            province: this.$route.params.province || ''
        }
    },
    methods: {
        goHome () {
            this.$router.push('/').then(() => {
                    this.$router.go(0);
                });
        }
    },
    watch: {
        search (newVal) {
            this.currentPage = 1;
            this.fitlerProperties = this.properties.filter((item) => item.title.toLowerCase().includes(newVal.toLowerCase()));
        }
    },
    computed: {
        displayProperties () {
            let from = (this.currentPage * this.perPage) - this.perPage;
            let to = (this.currentPage * this.perPage);
            if (this.province) {
                this.fitlerProperties = this.fitlerProperties.filter((property) => property.geo.province.toLowerCase() == this.province.toLowerCase())
                if (!this.fitlerProperties.length) {
                    
                }
            }
            if (this.sorting) {
                const sortinType = this.sorting.split('-');
                console.log(sortinType);
                if (sortinType[0] == 'price') {
                    return  sortinType[1] == 'asc' ? this.fitlerProperties.slice(from, to).sort((a,b) => a.price - b.price) : this.fitlerProperties.slice(from, to).sort((a,b) => b.price - a.price)
                }
                if (sortinType[0] == 'date') {
                    return  sortinType[1] == 'asc' ? this.fitlerProperties.slice(from, to).sort((a,b) => a.id - b.id) : this.fitlerProperties.slice(from, to).sort((a,b) => b.id - a.id)
                }
            }
            return this.fitlerProperties.slice(from, to);
        }
    }
}
</script>

<style>
  .pagination-container {
    display: flex;

    column-gap: 10px;
  }

  .paginate-buttons {
    height: 40px;

    width: 40px;

    border-radius: 20px;

    cursor: pointer;

    background-color: rgb(242, 242, 242);

    border: 1px solid rgb(217, 217, 217);

    color: black;
  }

  .paginate-buttons:hover {
    background-color: #d8d8d8;
  }

  .active-page {
    background-color: #3498db;

    border: 1px solid #3498db;

    color: white;
  }

  .active-page:hover {
    background-color: #2988c8;
  }
</style>