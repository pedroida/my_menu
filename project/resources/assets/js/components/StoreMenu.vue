<template>
  <div>
    <categories-menu
      @categoryChanged="categoryChanged"
      :categories-url="categoriesUrl">
    </categories-menu>

    <menu-data-list class="mt-5" :data-source="menuUrl"></menu-data-list>

  </div>
</template>

<script>
import CategoriesMenu from "./CategoriesMenu";
import MenuDataList from "./data-list/MenuDataList";

export default {
  name: "StoreMenu",

  components: {
    CategoriesMenu,
    MenuDataList,
  },

  props: {
    categoriesUrl: String,
    menuUrl: String,
  },

  methods: {
    categoryChanged(category) {
      const value = (category) ? category.id : category;
      this.$emit('setFilter', {
        urlKey: 'category',
        value
      })
    }
  }
}
</script>

<style scoped>
</style>