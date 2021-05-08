<template>
  <div>
    <div class="d-flex justify-content-center" v-if="showLoader">
      <div class="container-loader">
        <div class="lds-dual-ring"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "loader",

  props: {
    showLoader: {
      required: true
    }
  }
};
</script>

<style scoped>
.container-loader {
  width: 100%;
  height: 100%;
  text-align: center;
  background-color: #fcfcfc6b;
  z-index: 99999;
}
.lds-dual-ring {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 8px;
  border-radius: 50%;
  border: 6px solid #f44336;
  border-color: #f44336 transparent #f44336 transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
