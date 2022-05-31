<template>
  <button :class="{running: isLoading}" :disabled="isLoading" class="ld-ext-right">
    <slot></slot>
    <span class="ld ld-ring ld-spin"></span>
  </button>
</template>

<script setup lang="ts">
 const props = defineProps({
   isLoading: Boolean,
 });
</script>

<style scoped>
@import "ldbutton/index.min.css";
@import "@loadingio/loading.css/loading.min.css";
</style>
