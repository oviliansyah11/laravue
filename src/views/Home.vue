<template>
  <div class="home">
    <Header />
    <Hero />
    <Banner />
    <SectionIG />
    <Logo />
    <Footer />
  </div>
</template>

<script>
// @ is an alias to /src
import Header from "@/components/Header.vue";
import Hero from "@/components/Hero.vue";
import Banner from "@/components/Banner.vue";
import SectionIG from "@/components/SectionIG.vue";
import Logo from "@/components/Logo.vue";
import Footer from "@/components/Footer.vue";

export default {
  name: "Home",
  components: {
    Header,
    Hero,
    Banner,
    SectionIG,
    Logo,
    Footer,
  },
};
</script>
