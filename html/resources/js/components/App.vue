<template>
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-md-5">
                <label>Search</label>
                <input class="form-control" type="text" id="search" placeholder="Name,Province,.."/>
            </div>
            <div class="col-md-4">
                <label for="sorting">Sort By</label>
                <select type="text" class="form-control" id="province">
                    <option>-</option>
                    <option value="price-asc">Price (lowest to highest)</option>
                    <option value="price-desc">Price (highest to lowest)</option>
                    <option value="date-asc">Newest to Oldest</option>
                    <option value="date-desc">Oldest to Newest</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3" v-for="(property, index) in displayProperties">
                <h2>{{property.title}}</h2>
                <div>{{property.description}}</div>
            </div>
        </div>
        <div class="text-end">
            <vue-awesome-paginate
                  :total-items="properties.length"
                  :items-per-page="perPage"
                  :max-pages-shown="perPage"
                  v-model="currentPage"
            />
        </div>    
    </div>
</template>
<script>
import properties from '../../../../properties.json';
export default {
    data() {
        return {
        properties: properties,
        currentPage: 1,
        perPage: 25
        }
    },
    computed: {
        displayProperties () {
            let from = (this.currentPage * this.perPage) - this.perPage;
            let to = (this.currentPage * this.perPage);
            return  this.properties.slice(from, to);
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