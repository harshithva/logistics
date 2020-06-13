<template>
  <fragment>
    <Sidebar></Sidebar>
    <Main></Main>
  </fragment>
</template>

<script>
import Sidebar from "./Sidebar";
import Main from "./Main";

export default {
  components: {
    Main,
    Sidebar
  }
};
</script>