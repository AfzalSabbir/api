<template>
    <div>
        <input type="text" class="form-control col-md-4" v-model="query" autofocus>
        <br>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
              </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users" :key="user.id">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
          </tr>
      </tbody>
  </table>
  <pagination
  v-if="pagination.last_page > 1"
  :pagination="pagination"
  :offset="5"
  @paginate="query === '' ? getData() : searchData()"
  >
</pagination>
</div>
</template>

<script>
export default {
    name: 'UserComponent',
    data(){
        return {
            users: [],
            query: '',
            pagination: {
                current_page: 1
            }
        }
    },
    methods: {
        getData: function(){
            axios.get("/api/users?page=" + this.pagination.current_page)
            .then((response) => {
                this.users = response.data.data;
                this.pagination = response.data.meta;
            })
            .catch((exception) => {
                console.log(exception);
            });
        },
        searchData: function(){
            axios.get("/api/search/users/" + this.query + "?page=" + this.pagination.current_page
                )
            .then((response) => {
                this.users = response.data.data;
                this.pagination = response.data.meta;
            })
            .catch((exception) => {
                console.log(exception);
            });
        }
    },
    mounted() {
        this.getData();
    },
    watch: {
        query: function(newQ){
            if (newQ === "") {
                this.getData();
            } else {
                this.searchData();
            }
        }
    }
}
</script>
