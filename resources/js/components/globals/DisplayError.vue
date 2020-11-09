<template>
  <div>
    <div
      class="alert alert-danger"
      role="alert"
      v-for="(value, propertyName) in form.errors.errors"
      :key="propertyName"
    >
      {{ value[0] }}
    </div>
  </div>
</template>

<script>
export default {
  props: ["form"],
  name: "display-error",
};
</script>