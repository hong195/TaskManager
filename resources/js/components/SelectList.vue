<template>
  <div>
    <select @change="onChange($event)"
    >
      <option v-for="option in options"
              :value="option.id"
              :key="option.id"
              :selected="selectedOption === option.id"
      >
        {{ option.name }}
      </option>
    </select>
  </div>
</template>

<script>
  export default {
    name: 'SelectList',
    props: {
      options: {
        type: Array
      },
      selectedOption: {
        type: Number
      }
    },
    data() {
      return {
        selected: ''
      }
    },
    methods: {
      onChange($event) {
        const option = this.options.find( el => el.id === +$event.target.value)
        this.$emit('on-change', option)
      }
    }
  };
</script>
