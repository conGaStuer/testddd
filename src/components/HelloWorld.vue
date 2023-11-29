<template>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <!-- Sử dụng v-for để lặp qua mảng dữ liệu và hiển thị từng dòng trong bảng -->
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.username }}</td>
        <td>{{ user.password }}</td>
      </tr>
    </tbody>
  </table>
  <form action="" method="post">
    <input type="text" v-model="username" />
    <input type="text" name="" id="" v-model="password" />
    <input type="button" value="Submit" @click="addUser" />
  </form>
</template>

<script>
// Cài đặt Axios: npm install axios
import axios from "axios";
import { onMounted, ref } from "vue";
export default {
  setup() {
    const newUser = {
      username: "",
      password: "",
    };
    const users = ref();
    const fetchUser = () => {
      axios
        .get("http://localhost/test-backend/test-backend/src/api.php")
        .then((response) => {
          console.log(response.data);
          users.value = response.data;
          // Xử lý dữ liệu nhận được
        })
        .catch((error) => {
          console.error(error);
          // Xử lý lỗi
        });
    };
    const addUser = () => {
      axios
        .post("http://localhost/test-backend/test-backend/src/api.php")
        .then((response) => {
          console.log(response.data);
          fetchUser();
          // Xử lý dữ liệu nhận được
        })
        .catch((error) => {
          console.error(error);
          // Xử lý lỗi
        });
    };
    return {
      newUser,
      username,
      password,
      users,
      addUser,
      fetchUser,
    };
  },
  // data() {

  //   return {

  //     users: [],
  //   };
  // },
  // mounted() {
  //   axios
  //     .get("http://localhost/test-backend/test-backend/src/api.php")
  //     .then((response) => {
  //       console.log(response.data);
  //       this.users = response.data;
  //       // Xử lý dữ liệu nhận được
  //     })
  //     .catch((error) => {
  //       console.error(error);
  //       // Xử lý lỗi
  //     });
  // },
};
// Gửi GET request
</script>
