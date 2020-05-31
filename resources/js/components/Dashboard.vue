<template>
  <fragment>
    <Sidebar></Sidebar>
    <Main></Main>
    <Footer></Footer>
  </fragment>
</template>

<script>
import Header from "./Header";
import Sidebar from "./Sidebar";
import Main from "./Main";
import Footer from "./Footer";
export default {
  components: {
    Header,
    Main,
    Sidebar
  }
};
</script>