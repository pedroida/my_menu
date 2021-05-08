<template>
  <div class="categories-scroll pb-3 d-grid grid-auto-flow-column">
    <loader v-if="loading" :show-loader="loading"></loader>
    <template v-if="!loading">
      <div v-for="(category, index) in categories"
           :key="index"
           @click="selectCategory(category)"
           :class="{'active' : selectedCategory === category}"
           class="btn btn-round btn-category color-main border-main mr-3">
        {{ category.name }}
      </div>
    </template>
  </div>
</template>

<script>
export default {
  name: "CategoriesMenu",

  props: {
    categoriesUrl: String,
  },

  created() {
    this.getCategories()
  },

  watch: {
    selectedCategory(category) {
      this.$emit('categoryChanged', category)
    }
  },

  data() {
    return {
      categories: [],
      selectedCategory: null,
      loading: false,
    }
  },

  methods: {
    selectCategory(category) {
      this.selectedCategory = (category !== this.selectedCategory) ? category : null
    },
    getCategories() {
      this.loading = true;
      axios.get(this.categoriesUrl).then((response) => {
        if (response.data) {
          this.categories = response.data
        }
      }).catch((error) => console.log(error))
        .finally(() => this.loading = false)

    }
  }
}
</script>

<style lang="scss" scoped>
.btn-category {
  font-family: 'Nunito';
  font-size: 1.5em;
  background-color: #ffffff;

  &:hover, &:active, &.active {
    background-color: #f44336 !important;
    color: #ffffff !important;
  }
}

.categories-scroll {
  overflow-x: auto;

}

/* width */
::-webkit-scrollbar {
  height: 0.5rem;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 30px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #f44336;
  border-radius: 30px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #f44336;
}
</style>