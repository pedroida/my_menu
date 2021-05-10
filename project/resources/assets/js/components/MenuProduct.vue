<template>
  <div class="col-12 col-md-6">
    <div class="card card-hover card-main d-flex align-items-center product-card">

      <div v-if="product.promotional_price" class="ribbon"><span>Promoção</span></div>

      <div class="thumb d-grid">
        <img loading=lazy :src="product.thumbnail" :alt="product.name" class="m-auto">
      </div>
      <div class="card-body">
        <h3>{{ product.name }}</h3>
        <div class="product-description">{{ product.description }}</div>
        <span class="price" :class="{'old-price' : product.promotional_price}">
          R$ {{ product.price }}
        </span>
        <span v-if="product.promotional_price" class="price">R$ {{ product.promotional_price }}</span>

        <a :href="product.whatsapp_request" class="whatsapp" target="_blank">
          <i class="fab fa-whatsapp fa-2x"></i>
        </a>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MenuProduct",

  props: {
    product: Object,
  }
}
</script>

<style lang="scss" scoped>
.product-card {
  flex-direction: row;

  .product-description {
    white-space: break-spaces;
  }

  .price {
    display: block;
    font-weight: 700;
    font-size: 24px;
    color: #F0542C;
    font-family: "Montserrat", sans-serif;

    &.old-price {
      text-decoration: line-through;
      color: #5a5a5a;
      font-size: 15px;
    }
  }
}

.thumb {
  min-width: 40%;
  max-width: 40%;
  max-height: 100%;

  img {
    max-width: 100%;
    max-height: 80%;
  }
}

.ribbon {
  position: absolute;
  right: -5px; top: -5px;
  z-index: 1;
  overflow: hidden;
  width: 75px; height: 75px;
  text-align: right;
}
.ribbon span {
  font-size: 10px;
  font-weight: bold;
  color: #FFF;
  text-transform: uppercase;
  text-align: center;
  line-height: 20px;
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  width: 100px;
  display: block;
  background: #79A70A;
  background: linear-gradient(#F44336 0%, #f44336 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 19px; right: -21px;
}
.ribbon span::before {
  content: "";
  position: absolute; left: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid #f44336;
  border-right: 3px solid transparent;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #f44336;
}
.ribbon span::after {
  content: "";
  position: absolute; right: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid transparent;
  border-right: 3px solid #f44336;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #f44336;
}

.whatsapp {
  position: absolute;
  bottom: .5rem;
  right: .5rem;
  background-color: #05d755;
  border-radius: 50%;
  color: white;
  width: 3em;
  height: 3em;

  &:hover {
    background-color: #0a8e3b;
  }

  i {
    font-size: 2em !important;
    margin: 7px 9px !important;
  }
}

</style>