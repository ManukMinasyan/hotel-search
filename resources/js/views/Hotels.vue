<template>
    <div>
        <el-form ref="form" :inline="true" :model="searchForm">
            <el-form-item label="Name">
                <el-input v-model="searchForm.name"></el-input>
            </el-form-item>
            <el-form-item label="Bedrooms">
                <el-input-number v-model="searchForm.bedrooms"></el-input-number>
            </el-form-item>
            <el-form-item label="Bathrooms">
                <el-input-number v-model="searchForm.bathrooms"></el-input-number>
            </el-form-item>
            <el-form-item label="Storeys">
                <el-input-number v-model="searchForm.storeys"></el-input-number>
            </el-form-item>
            <el-form-item label="Garages">
                <el-input-number v-model="searchForm.garages"></el-input-number>
            </el-form-item>
            <div class="block">
                <label class="el-form-item__label">Price</label>
                <el-slider
                        v-model="searchForm.price"
                        range
                        show-stops
                        :step="1000"
                        :max="1000000">
                </el-slider>
            </div>
            <el-form-item>
                <el-button type="primary" @click="applyFilters">Search</el-button>
                <el-button @click.prevent="cancelFilters">Cancel</el-button>
            </el-form-item>
        </el-form>
        <el-table
                :lazy="loading"
                :data="hotelsData"
                height="500"
                style="width: 100%">
            <el-table-column
                    prop="name"
                    label="Name"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="bedrooms"
                    label="Bedrooms"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="bathrooms"
                    label="Bathrooms">
            </el-table-column>
            <el-table-column
                    prop="storeys"
                    label="Storeys">
            </el-table-column>
            <el-table-column
                    prop="garages"
                    label="Garages">
            </el-table-column>
            <el-table-column
                    prop="price"
                    label="Price">
            </el-table-column>
        </el-table>
    </div>
</template>

<script>
  import http from '../services/http'

  let searchModel = {
    name: '',
    bedrooms: 0,
    bathrooms: 0,
    storeys: 0,
    garages: 0,
    price: [1, 1000000],
  }

  export default {
    name: 'Hotels',
    data () {
      return {
        loading: false,
        searchForm: JSON.parse(JSON.stringify(searchModel)),
        hotelsData: [],
      }
    },
    created () {
      this.getHotels()
    },
    methods: {
      async search (data) {
        try {
          this.loading = true

          const searchData = Object.keys(data).filter(key => data[key] !== 0).reduce((obj, key) => {
            obj[key] = data[key]
            return obj
          }, {})

          const response = await http.get('hotels/filter', { params: searchData });

          this.hotelsData = [...response.data.data]

        } catch (error) {
          console.log(error)
        } finally {
          this.loading = false
        }
      },
      getHotels () {
        http.get('hotels').then(r => {
          this.hotelsData = r.data.data
        })
      },
      applyFilters () {
        const [start, end] = this.searchForm.price
        let data = {
          ...this.searchForm,
          price: { start, end },
        }

        this.search(data);
      },
      cancelFilters () {
        this.$set(this.$data, 'searchForm', JSON.parse(JSON.stringify(searchModel)))
        this.getHotels();
      },
    },
  }
</script>