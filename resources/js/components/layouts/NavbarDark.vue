<template>
  <nav v-if="session.user_id != null" class="navbar navbar-expand-lg -dark">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img class="navbar-brand__logo" src="/storage/images/logo.png" alt="construct.ph logo" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item v-center mr-2 active">
            <a class="nav-link -white fw-500" href="/">
              Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item v-center mr-2 dropdown">
            <a
              class="nav-link -white fw-500 dropdown-toggle"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >Jobs</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/jobs">Job Posts</a>
              <a class="dropdown-item" href="#">Job Entries</a>
              <a class="dropdown-item" href="#">Active Jobs</a>
              <a class="dropdown-item" href="#">Posted Jobs</a>
            </div>
          </li>
          <li class="nav-item v-center mr-4">
            <a class="nav-link -white fw-500" :href="'/profile/' + session.user_username">Profile</a>
          </li>
          <li class="nav-item v-center mr-1 dropdown">
            <a
              class="nav-link -white fw-500"
              style="font-size: 20px"
              href="#"
              id="navbarMessages"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="far fa-envelope"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarMessages">
              <ul>
                <li class="dropdown-item">message</li>
                <li class="dropdown-item">message</li>
              </ul>
            </div>
          </li>
          <li class="nav-item v-center dropdown">
            <a
              class="nav-link -white fw-500"
              style="font-size: 20px"
              href="#"
              id="navbarNotifications"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="far fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarNotifications">
              <ul>
                <li class="dropdown-item">notif</li>
                <li class="dropdown-item">notif</li>
              </ul>
            </div>
          </li>
          <li class="nav-item v-center mr-2 dropdown">
            <a
              class="nav-link -white fw-500"
              style="font-size: 20px"
              href="#"
              id="navbarWorks"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="fas fa-hard-hat"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarWorks">
              <ul>
                <li class="dropdown-item">work</li>
                <li class="dropdown-item">work</li>
              </ul>
            </div>
          </li>
          <li class="nav-item v-center dropdown">
            <a
              class="nav-link -white fw-500 px-0 py-0"
              href="#"
              id="navbarDropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <div
                class="container--img-border overflow-hidden rounded-circle"
                style="height: 50px; width: 50px"
              >
                <img
                  v-if="session.user_image != null"
                  class="img--responsive"
                  :src="'/storage/images/profile-images/' + session.user_image"
                  :alt="session.account_username"
                />
                <img
                  v-else
                  class="img--responsive"
                  src="/storage/images/profile-images/default.png"
                  :alt="session.account_username"
                />
              </div>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a v-if="session.user_type == 4" class="dropdown-item" href="/account/companies">
                <i class="far fa-building"></i>&ensp;My Companies
              </a>
              <a class="dropdown-item" href="/bookmarks">
                <i class="far fa-bookmark"></i>&ensp;Bookmarks
              </a>
              <a class="dropdown-item" href="/settings">
                <i class="fas fa-cog"></i>&ensp;Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" :href="logout" @click="logout">
                <i class="fas fa-sign-out-alt"></i>&ensp;Logout
              </a>
              <form id="logout-form" action="/logout" method="POST" style="display: none;">
                <input type="hidden" name="_token" :value="csrf" />
              </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <nav v-else class="navbar navbar-expand-lg -dark">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="/storage/images/logo.png" alt="construct.ph logo" />
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-2 active">
            <a class="nav-link -white fw-500" href="/">
              Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item mr-2">
            <a class="nav-link -white fw-500" href="/about">About</a>
          </li>
          <li class="nav-item mr-4">
            <a class="nav-link -white fw-500" href="/contact">Contact</a>
          </li>
          <div class="my-2 my-lg-0 nav__btn">
            <a class="btn -lime mr-sm-2" href="/login">Login</a>
            <a class="btn -lime-outline my-2 my-sm-0" href="/register">Register</a>
          </div>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import _ from "lodash";
import axios from "axios";

export default {
  props: ["session"],
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content")
    };
  },
 //  created() {
 //  	axios.get("/api/job-invitations").then(res => {
 //  		console.log(res.data);
 //  	}).catch(function (error) {	
	// 	console.log(error);
	// });
 //  },
  methods: {
    logout(event) {
      event.preventDefault();
      document.getElementById("logout-form").submit();
    }
  }
};
</script>