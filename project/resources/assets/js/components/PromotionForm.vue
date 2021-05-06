<template>
  <div class="form-row">

    <div class="form-group col-12 col-md-6">
      <label for="type">
        Tipo de promoção<span class="text-danger ml-1">*</span>
      </label>

      <select
        v-model="type"
        name="type"
        id="type"
        :class="{ 'is-invalid': hasError('type') }"
        class="form-control">
        <option value="percentage">Porcentagem</option>
        <option value="value_to_discount">Valor de desconto</option>
      </select>
      <div v-if="hasError('type')" class="invalid-feedback d-block">
        {{ getError("type") }}
      </div>
    </div>

    <div class="form-group col-12 col-md-6">
      <label for="value">
        {{ discountLabel }}<span class="text-danger ml-1">*</span>
      </label>

      <input
        key="value-percentage"
        v-if="isPercentageDiscount"
        v-model="discountValue"
        type="tel"
        name="value"
        id="percentage"
        :class="{ 'is-invalid': hasError('value') }"
        class="form-control mask-integer">

      <input
        key="value-discount"
        v-if="!isPercentageDiscount"
        v-model="discountValue"
        type="text"
        name="value"
        id="value"
        :class="{ 'is-invalid': hasError('value') }"
        v-money="moneyMask"
        class="form-control">


      <div v-if="hasError('value')" class="invalid-feedback d-block">
        {{ getError("value") }}
      </div>
    </div>

    <div class="form-group col-12">
      <multiselect
        v-model="promotionProducts"
        :options="products"
        :multiple="true"
        label="name"
        track-by="name"
        select-label=""
        deselect-label=""
        placeholder="Selecione os produtos"
        :close-on-select="false">
        <template #noResult>
          Nenhum produto encontrado
        </template>
      </multiselect>
      <div v-if="hasError('products')" class="invalid-feedback d-block">
        {{ getError("products") }}
      </div>
    </div>

    <input v-for="(product, index) in promotionProducts" :key="index" name="products[]" :value="product.id"
           type="hidden">
  </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css';

export default {
  name: "PromotionForm",

  props: {
    promotion: Object,
    old: Array | Object,
    products: Array,
    errors: {
      required: false
    }
  },

  components: {Multiselect},

  computed: {
    discountLabel() {
      return (this.isPercentageDiscount) ? 'Porcentagem de desconto' : 'Valor do Desconto';
    },

    isPercentageDiscount() {
      return this.type === 'percentage'
    },

    moneyMask() {
      return {
        decimal: ",",
        thousands: "",
        precision: 2,
        masked: false
      }
    }
  },

  watch: {
    type: {
      handler() {
        if (this.isPercentageDiscount)
          this.discountValue = this.promotion.value.toString();
      }
    }
  },

  data() {
    return {
      promotionProducts: this.getInitialSelectedProducts(),
      type: _.get(this.old, 'type', this.promotion.type),
      discountValue: _.get(this.old, 'value', this.promotion.value.toString()),
    }
  },

  methods: {
    getInitialSelectedProducts() {
      if (!this.old.length && Array.isArray(this.old))
        return this.promotion.products

      const products = this.old.products;
      console.log(products)
      console.log(this.products.filter((product) => products.includes(product.id.toString())))
      return this.products.filter((product) => products.includes(product.id.toString()))
    },

    getError(key) {
      return this.errors[key][0];
    },
    hasError(key) {
      return !!this.errors[key];
    },
  }
}
</script>

<style lang="scss">
.multiselect__tag, .multiselect__option--highlight, .multiselect__tag-icon:after, .multiselect__tag-icon:hover {
  background: #6777ef !important;
}
</style>