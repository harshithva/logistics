<template>
  <form class="text-left" @submit.prevent="login">
    <b-alert
      :show="dismissCountDown"
      dismissible
      variant="danger"
      @dismissed="dismissCountDown=0"
      @dismiss-count-down="countDownChanged"
    >Invalid Credentials</b-alert>

    <div class="form">
      <div id="username-field" class="field-wrapper input">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="feather feather-user"
        >
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
          <circle cx="12" cy="7" r="4" />
        </svg>
        <input
          id="email"
          type="email"
          class="form-control"
          v-model="email"
          required
          autocomplete="email"
          autofocus
        />
      </div>

      <div id="password-field" class="field-wrapper input mb-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="feather feather-lock"
        >
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
          <path d="M7 11V7a5 5 0 0 1 10 0v4" />
        </svg>
        <input
          id="password"
          type="password"
          class="form-control"
          v-model="password"
          required
          autocomplete="current-password"
        />
      </div>
      <div class="d-sm-flex justify-content-between">
        <div class="field-wrapper toggle-pass">
          <p class="d-inline-block">Show Password</p>
          <label class="switch s-primary">
            <input type="checkbox" id="toggle-password" class="d-none" @click="showPassword" />
            <span class="slider round"></span>
          </label>
        </div>
        <div class="field-wrapper">
          <button type="submit" class="btn btn-primary" value="submit">Log In</button>
        </div>
      </div>

      <div class="field-wrapper text-center keep-logged-in">
        <div class="n-chk new-checkbox checkbox-outline-primary">
          <label class="new-control new-checkbox checkbox-outline-primary">
            <input class="new-control-input" type="checkbox" name="remember" id="remember" />

            <span class="new-control-indicator"></span>Keep me logged in
          </label>
        </div>
      </div>
      <div class="field-wrapper">
        <a href="password/reset" class="forgot-pass-link">Forgot Password?</a>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      dismissSecs: 5,
      dismissCountDown: 0
    };
  },

  methods: {
    async login() {
      await axios.get("/sanctum/csrf-cookie");
      this.$store
        .dispatch("login", {
          email: this.email,
          password: this.password
        })
        .then(() => {
          const userInfo = this.$store.getters.getUserData;

          if (userInfo.user.role == "admin") {
            window.location = "/admin";
          } else if (userInfo.user.role == "employee") {
            window.location = "/staff";
          } else if (userInfo.user.role == "customer") {
            window.location = "/customer";
          }
        })
        .catch(err => {
          this.dismissCountDown = 10;
        });
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
    showPassword() {
      const x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  }
};
</script>