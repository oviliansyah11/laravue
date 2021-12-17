<template>
  <!-- Header Section Begin -->
  <header class="header-section">
    <div class="container">
      <div class="inner-header">
        <div class="row">
          <div class="col-lg-2 col-md-2">
            <div class="logo">
              <a href="./index.html">
                <img src="img/logo_website_shayna.png" alt="" />
              </a>
            </div>
          </div>
          <div class="col-lg-7 col-md-7"></div>
          <div class="col-lg-3 text-right col-md-3">
            <ul class="nav-right">
              <li class="cart-icon">
                Keranjang Belanja &nbsp;
                <a href="#">
                  <i class="icon_bag_alt"></i>
                  <span>{{ cartUser.length }}</span>
                </a>
                <div class="cart-hover">
                  <div class="select-items">
                    <table>
                      <tbody v-if="cartUser.length > 0">
                        <tr v-for="item in cartUser" :key="item.id">
                          <td class="si-pic">
                            <img :src="item.photo" alt="" height="70px" />
                          </td>
                          <td class="si-text">
                            <div class="product-selected">
                              <p>{{ item.price }} x 1</p>
                              <h6>{{ item.name }}</h6>
                            </div>
                          </td>
                          <td class="si-close" @click="removeItem(item.id)">
                            <i class="ti-close"></i>
                          </td>
                        </tr>
                      </tbody>
                      <tbody v-else>
                        <tr>
                          <td class="text-center text-warning">
                            <strong>Product is empty</strong>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="select-total">
                    <span>total:</span>
                    <h5>${{ totalPrice }}.00</h5>
                  </div>
                  <div class="select-button">
                    <router-link to="/cart" class="primary-btn view-card"
                      >CHECK OUT</router-link
                    >
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      cartUser: [],
    };
  },
  methods: {
    removeItem(idx) {
      let cartUserStorage = JSON.parse(localStorage.getItem("cartUser"));
      let itemCartUserStorage = cartUserStorage.map(
        (itemCartUserStorage) => itemCartUserStorage.id
      );
      let index = itemCartUserStorage.findIndex((id) => id == idx);
      this.cartUser.splice(index, 1);

      const parsed = JSON.stringify(this.cartUser);
      localStorage.setItem("cartUser", parsed);
      window.location.reload();
    },
  },
  mounted() {
    if (localStorage.getItem("cartUser")) {
      try {
        this.cartUser = JSON.parse(localStorage.getItem("cartUser"));
      } catch (e) {
        localStorage.removeItem("cartUser");
      }
    }
  },
  computed: {
    totalPrice() {
      return this.cartUser.reduce(function (items, data) {
        return items + data.price;
      }, 0);
    },
  },
};
</script>
