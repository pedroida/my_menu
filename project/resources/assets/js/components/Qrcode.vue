<template>
  <div>
    <vue-qrcode id="qrcode" :value="url" />

    <button type="button" class="btn btn-outline-primary" @click="download">Baixar QRCode</button>
  </div>
</template>

<script>
import VueQrcode from 'vue-qrcode'

export default {
  name: "Qrcode",

  components: {
    VueQrcode,
  },

  props: {
    url: String,
  },

  methods: {
    download() {
      const base64 = document.getElementById('qrcode').src
      const a = document.createElement("a")
      a.href = base64
      a.download = "Image.png"
      a.click()
      a.remove()
    }
  }
}
</script>

<style scoped>

</style>