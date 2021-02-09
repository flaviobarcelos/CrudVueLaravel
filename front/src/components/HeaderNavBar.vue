<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <span class="navbar-brand mb-0 h1">{{title}}</span>
      </div>
    </nav>
</template>

<script setup>
import { defineProps, reactive } from 'vue'

defineProps({
  title: String
})

</script>

<style scoped>
a {
  color: #42b983;
}
</style>