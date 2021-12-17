<template>
  <div class="product">
    <Header />
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section text-left">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text product-more">
              <router-link to="/"><i class="fa fa-home"></i> Home</router-link>
              <span>Cart</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-12">
                <div class="cart-table">
                  <table>
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th class="p-name text-center">Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody v-if="cartUser.length > 0">
                      <tr v-for="item in cartUser" :key="item.id">
                        <td class="cart-pic first-row">
                          <img :src="item.photo" />
                        </td>
                        <td class="cart-title first-row text-center">
                          <h5>{{ item.name }}</h5>
                        </td>
                        <td class="p-price first-row">{{ item.price }}</td>
                        <td class="si-close" @click="removeItem(cartUser.id)">
                          <i class="ti-close" style="cursor: pointer"></i>
                        </td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="4" class="text-warning">
                          <strong>Your cart is empty</strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-8 text-left">
                <h4 class="mb-4">Customer Information:</h4>
                <div class="user-checkout">
                  <form>
                    <div class="form-group">
                      <label for="namaLengkap">Fullname</label>
                      <input
                        type="text"
                        class="form-control"
                        aria-describedby="namaHelp"
                        placeholder="Please input your name"
                        v-model="customerInfo.name"
                      />
                    </div>
                    <div class="form-group">
                      <label for="namaLengkap">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        id="emailAddress"
                        aria-describedby="emailHelp"
                        placeholder="Input your Email"
                        v-model="customerInfo.email"
                      />
                    </div>
                    <div class="form-group">
                      <label>Phone</label>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="Phone number"
                        v-model="customerInfo.number"
                      />
                    </div>
                    <div class="form-group">
                      <label for="alamatLengkap">Address</label>
                      <textarea
                        class="form-control"
                        id="alamatLengkap"
                        rows="3"
                        v-model="customerInfo.address"
                      ></textarea>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <div class="proceed-checkout">
                  <ul>
                    <li class="subtotal">
                      ID Transaction <span>#SH12000</span>
                    </li>
                    <li class="subtotal mt-3">
                      Subtotal <span>${{ totalPrice }}</span>
                    </li>
                    <li class="subtotal mt-3">Tax <span>10%</span></li>
                    <li class="subtotal mt-3">
                      Price Total <span>${{ totalAllPrice }}</span>
                    </li>
                    <li class="subtotal mt-3">
                      Bank Transfer <span>Mandiri</span>
                    </li>
                    <li class="subtotal mt-3">
                      No. Rekening <span>2208 1996 1403</span>
                    </li>
                    <li class="subtotal mt-3">
                      Nama Penerima <span>Ovi</span>
                    </li>
                  </ul>
                  <!-- <router-link to="/success" class="proceed-btn"> -->
                  <a href="#" @click="checkout()" class="proceed-btn"
                    >I ALREADY PAID</a
                  >
                  <!-- </router-link> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shopping Cart Section End -->

    <Footer />
  </div>
</template>

<script>
// @ is an alias to /src
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";
import axios from "axios";

export default {
  name: "Cart",
  components: {
    Header,
    Footer,
  },
  data() {
    return {
      cartUser: [],
      customerInfo: {
        name: "",
        email: "",
        number: "",
        address: "",
      },
    };
  },
  methods: {
    removeItem(index) {
      this.cartUser.splice(index, 1);
      const parsed = JSON.stringify(this.cartUser);
      localStorage.setItem("cartUser", parsed);
    },
    checkout() {
      let productsId = this.cartUser.map(function (product) {
        return product.id;
      });

      let checkoutData = {
        name: this.customerInfo.name,
        email: this.customerInfo.email,
        number: this.customerInfo.number,
        address: this.customerInfo.address,
        transaction_total: this.totalAllPrice,
        transaction_status: "PENDING",
        transaction_details: productsId,
      };

      axios
        .post("http://127.0.0.1:8000/api/checkout", checkoutData)
        .then((response) => console.log(response))
        .catch((err) => {
          console.log(err);
          console.log(err.response.data);
        });
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
    totalPax() {
      return (this.totalPrice * 10) / 100;
    },
    totalAllPrice() {
      return this.totalPrice + this.totalPax;
    },
  },
};
</script>
