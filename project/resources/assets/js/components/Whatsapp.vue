<template>
  <div class="form-group">
    <label for="whats">Número do whats</label>
    <div class="input-group">
      <input v-model="whatsapp" type="text" id="whats" name="whats" class="form-control mask-cellphone">
      <div class="input-group-append">
        <button @click="save" class="btn btn-outline-primary" :disabled="!whatsapp">Salvar</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Whatsapp",

  props: {
    updateUrl: String,
    whats: String | undefined,
  },

  data() {
    return {
      whatsapp: this.whats,
    }
  },

  methods: {
    save() {
      axios.post(this.updateUrl, {
        whatsapp: this.whatsapp
      }).then((response) => {
        this.$root.flashMessage(response.data.type, response.data.message);
      }).catch(() => {
        this.$root.flashMessage('error', 'Houve um problema ao salvar o whatsapp');
      })
    }
  }
}
</script>

<style scoped>

</style>